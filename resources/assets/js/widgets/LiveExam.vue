<template>
  <section>
    <b-row>
      <b-col v-if="isExam">
        <b-row>
          <b-col md="12">
            <h3>
              <span
                v-if="timeLeft.totalSeconds > 0"
              >( {{timeLeft.minutesLabel}}:{{timeLeft.secondsLabel}} นาที) ::</span>
              {{questions.question}}
            </h3>
          </b-col>
        </b-row>
        <b-col sm="6" class="m-b-3" v-for="(ch, i) in questions.choice" :key="i">
          <b-button
            variant="primary"
            style="min-height: 45px;min-width:90px;"
            v-text="ch.text"
            :disabled="isAns"
            @click="answer(ch.text)"
          />
        </b-col>
      </b-col>
    </b-row>
    <b-row v-if="users.length > 0">
      <b-col>
        <h4>อันดับ</h4>
        <b-col md="3" v-for="(user, i) in users" :key="i">
          <h5>{{ i + 1}}. {{ user.firstname }} {{ user.lastname }}</h5>
          <span>{{user.point}} คะแนน</span>
        </b-col>
      </b-col>
    </b-row>
  </section>
</template>

<script>
export default {
    props: ["socket", "roomId", "user"],
    data() {
        return {
            status: "",
            isExam: false,
            isAns: false,
            questions: {},
            timeLeft: {},
            interval: "",
            users: []
        };
    },
    watch: {
        roomId(roomId) {
            if (roomId) {
                this.listener();
                console.log(roomId);
            }
        }
    },
    methods: {
        initTime(time) {
            this.timeLeft = {
                totalSeconds: time,
                minutesLabel: "00",
                secondsLabel: "00"
            };
        },
        setTime() {
            if (this.timeLeft.totalSeconds <= 0 && !this.isAns) {
                this.answer("");
                return;
            }
            --this.timeLeft.totalSeconds;
            this.timeLeft.secondsLabel = this.pad(
                this.timeLeft.totalSeconds % 60
            );
            this.timeLeft.minutesLabel = this.pad(
                parseInt(this.timeLeft.totalSeconds / 60)
            );
        },
        pad(val) {
            var valString = val + "";
            if (valString.length < 2) {
                return "0" + valString;
            } else {
                return valString;
            }
        },
        listener() {
            this.socket.on(this.roomId + "/start exam", data => {
                console.log("start examp");
                this.socket.emit(this.roomId + "/join exam", this.user);
                this.isExam = true;
            });
            this.socket.on(this.roomId + "/next exam", data => {
                console.log("next exam");
                console.log(data);
                if(this.interval) {
                    clearInterval(this.interval);
                }
                const self = this;
                this.isAns = false;
                this.initTime(data.time * 60);
                this.interval = setInterval(function() {
                    self.setTime();
                }, 1000);
                this.questions = data;
            });
            this.socket.on(this.roomId + "/end exam", data => {
                console.log("end examp");
                this.isExam = false;
            });
            this.socket.on(this.roomId + "/result exam", data => {
                console.log("result exam");
                this.users = data.sort((a, b) => {
                  return b.point - a.point
                });
            });
            this.socket.on(this.roomId + "/end exam", data => {
                console.log("result exam");
                this.users = data.sort((a, b) => {
                  return b.point - a.point
                });
            });
        },
        answer(text) {
            console.log("answer exam");
            const payload = {
                text,
                user: this.user,
                timeLeft: this.timeLeft.totalSeconds
            };
            this.isAns = true;
            this.socket.emit(this.roomId + "/answer exam", payload);
        }
    }
};
</script>

<style>
</style>
