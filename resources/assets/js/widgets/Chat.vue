<template>
  <div class="chatbox">
    <div class="message" v-for="(item, i) in chats" :key="i">
      <span
        :class="[item.user_id === course.user_id ? 'user-name-teacher' : 'user-name' ]"
      >{{ item.name }} :&nbsp;</span>
      <span class="text">{{ item.message }}</span>
      <span class="time">{{ item.time }}</span>
    </div>
    <div class="input">
      <input
        id="chat-text-input"
        type="text"
        class="form-control"
        placeholder="พิมพ์ข้อความที่นี่"
        @keyup="handleMessage"
        :disabled="loading"
      >
    </div>
  </div>
</template>

<script>
export default {
    props: ["courseId", "user", "roomId", "course", "socket"],
    watch: {
        roomId(val) {
            if (val) {
                this.listener();
            }
        }
    },
    data() {
        return {
            chats: [],
            loading: false
        };
    },
    mounted() {
        axios
            .get(`/api/chat/${this.courseId}`)
            .then(({ data }) => {
                data.map(item => {
                    const temp = {
                        user_id: item.user.id,
                        name: `${item.user.firstname} ${item.user.lastname}`,
                        message: item.message,
                        time: item.time
                    };
                    this.chats.push(temp);
                });
                setTimeout(() => {
                    $(".chatbox").animate(
                        { scrollTop: $(".chatbox").prop("scrollHeight") },
                        1000
                    );
                }, 500);
            })
            .catch(error => {
                console.log(error);
                if (error.response) console.log(error.response);
            });
    },
    methods: {
        listener() {
            const self = this;
            this.socket.on(this.roomId + "/chat message", msg => {
                this.chats.push(msg);
                if (msg.user_id == self.user.id) {
                    const data = {
                        user_id: self.user.id,
                        course_id: self.course.id,
                        message: msg.message,
                        time: msg.time
                    };
                    axios.post("/api/chat", data).catch(error => {
                        console.log(error);
                        if (error.response) {
                            console.log(error.response);
                            swal({
                                type: "error",
                                title: "Oops...",
                                text: error.response.data.message
                            });
                        }
                    });
                }
                $(".chatbox").animate(
                    { scrollTop: $(".chatbox").prop("scrollHeight") },
                    1000
                );
            });
        },
        handleMessage(event) {
            if (event.key === "Enter" && event.target.value !== "") {
                this.loading = true;
                const payload = {
                    user_id: this.user.id,
                    name: this.user.firstname + " " + this.user.lastname,
                    message: event.target.value
                };
                this.socket.emit(this.roomId + "/chat message", payload);
                event.target.value = "";
                setTimeout(() => {
                    this.loading = false;
                    setTimeout(() => {
                        $("#chat-text-input").focus();
                    }, 300);
                }, 800);
            }
        }
    }
};
</script>

<style>
</style>
