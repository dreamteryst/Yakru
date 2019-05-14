<template>
  <section>
    <b-row>
      <b-col>
        <b-row v-if="!isEnd">
          <b-col md="6">
            <h4>เมนูข้อสอบ</h4>
            <button class="btn btn-block btn-info" v-if="!isExam" @click="openExam">เริ่มทำข้อสอบ</button>
            <b-row class="m-t-3 m-b-3" v-if="isExam">
              <b-col md="4">กำหนดเวลา</b-col>
              <b-col md="6">
                <b-form-input v-model="time"></b-form-input>
              </b-col>
              <b-col md="2">นาที</b-col>
            </b-row>
            <button
              class="btn btn-block btn-success"
              v-if="isExam"
              :disabled="timeLeft.totalSeconds > 0"
              @click="nextExam"
            >
              <span
                v-if="timeLeft.totalSeconds > 0"
              >( {{timeLeft.minutesLabel}}:{{timeLeft.secondsLabel}} นาที) ::</span> ส่งคำถาม
            </button>
            <button class="btn btn-block btn-danger" v-if="!checkEnd" @click="endExam">สิ้นสุด</button>
          </b-col>
          <b-col md="6" v-if="isExam && this.selectedEx.question[index + 1]">
            <b-row>
              <b-col md="12">
                <strong>คำถามข้อที่ {{index+2}} {{this.selectedEx.question[index + 1].question}}</strong>
              </b-col>
            </b-row>
            <b-col
              sm="6"
              class="m-b-3"
              v-for="(ch, i) in this.selectedEx.question[index + 1].choice"
              :key="i"
            >
              <p>{{ch.text}}</p>
            </b-col>
          </b-col>
        </b-row>
        <b-row v-if="users.length > 0">
          <b-col>
            <h4>อันดับ</h4>
            <b-col md="3" v-for="(user, i) in users" :key="i">
              <h5> {{ i + 1}}. {{ user.firstname }} {{ user.lastname }}</h5>
              <span>{{user.point}} คะแนน</span>
            </b-col>
          </b-col>
        </b-row>
      </b-col>
    </b-row>
    <b-modal ref="modalExam" no-fade title="เลือกข้อสอบ" @ok="startExam">
      <b-list-group>
        <b-list-group-item
          v-for="(exam, i) in exams"
          :key="i"
          @click="select(i)"
          :class="{'active': selected === i}"
        >{{i + 1}}. {{ exam.example_type }}</b-list-group-item>
      </b-list-group>
    </b-modal>
  </section>
</template>

<script>
export default {
    props: ["socket", "roomId", "courseId"],
    watch: {
      roomId(val) {
        if(val) {
          this.listener()
        }
      }
    },
    data() {
        return {
            exams: [],
            selected: -1,
            index: -1,
            time: 1,
            timeLeft: {},
            isExam: false,
            isEnd: false,
            selectedEx: {},
            interval: "",
            users: []
        };
    },
    mounted() {
        axios.get(`/api/example/course/${this.courseId}`).then(({ data }) => {
            this.exams = data;
        });
    },
    methods: {
        listener() {
          console.log('listener '+this.roomId)
            this.socket.on(this.roomId + "/result exam", data => {
                console.log("result exam");
                this.users = data.sort((a, b) => {
                  return b.point - a.point
                });
            });
            this.socket.on(this.roomId + "/end exam", data => {
                console.log("end exam");
                this.isEnd = true
                this.isExam = false
                this.users = data.sort((a, b) => {
                  return b.point - a.point
                });
            });
        },
        checkEnd() {
            return (
                this.selected != -1 &&
                this.index + 1 >= this.exams[this.selected].question.length
            );
        },
        openExam() {
            this.$refs.modalExam.show();
        },
        select(i) {
            this.selected = i;
        },
        startExam() {
            if (this.selected == -1) {
                this.alertWarning("กรุณาเลือกแบบทสอบ");
                return;
            }
            console.log("start examp");
            this.selectedEx = { ...this.exams[this.selected] };
            this.selectedEx.question = this.selectedEx.question.map(item => {
                return {
                    ...item,
                    ansText: item.choice.find(
                        (ch, index) => index + 1 == item.ans
                    ).text
                };
            });
            this.selectedEx.question = this.shuffle(this.selectedEx.question);
            this.isExam = true;
            this.socket.emit(this.roomId + "/start exam", this.selectedEx);
        },
        nextExam() {
            console.log("next exam");
            const self = this;

            this.index++;
            this.socket.emit(this.roomId + "/next exam", {
                i: this.index,
                time: this.time
            });
            this.initTime(this.time * 60);
            this.interval = setInterval(function() {
                self.setTime();
            }, 1000);
        },
        endExam() {
            console.log("end exam");
            this.index = -1;
            this.isExam = false;
            this.selected = -1;
            this.selectedEx = {};
        },
        initTime(time) {
            this.timeLeft = {
                totalSeconds: time,
                minutesLabel: "00",
                secondsLabel: "00"
            };
        },
        setTime() {
            if (this.timeLeft.totalSeconds <= 0) {
                clearInterval(this.interval);
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
        }
    }
};
</script>

<style>
</style>
