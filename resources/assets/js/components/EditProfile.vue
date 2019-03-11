<template>
  <b-modal ref="modal" title="แก้ไขข้อมูลส่วนตัว" @ok="submit" no-fade>
    <b-row>
      <b-col>
        <b-form-group label="ชื่อ">
          <b-form-input name="name" v-model="profile.firstname"></b-form-input>
        </b-form-group>
      </b-col>
    </b-row>
    <b-row>
      <b-col>
        <b-form-group label="นามสกุล">
          <b-form-input name="lastname" v-model="profile.lastname"></b-form-input>
        </b-form-group>
      </b-col>
    </b-row>
  </b-modal>
</template>

<script>
import { mapState } from "vuex";
export default {
    data() {
        return {
            profile: ""
        };
    },
    computed: {
        ...mapState(["user"])
    },
    methods: {
        show() {
            this.$refs.modal.show();
        },
        submit() {
            const payload = new FormData();
            payload.append("firstname", this.profile.firstname);
            payload.append("lastname", this.profile.lastname);
            axios
                .post("/api/user/update", payload)
                .then(() => {
                    this.alertSuccess();
                })
                .catch(error => {
                    if (error.response.data.message) {
                        this.alertWarning(error.response.data.message);
                    }
                });
        }
    },
    watch: {
        user() {
            this.profile = { ...this.user };
        }
    }
};
</script>

<style>
</style>
