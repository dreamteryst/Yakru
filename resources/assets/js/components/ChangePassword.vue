<template>
  <b-modal ref="modal" title="แก้ไขรหัสผ่าน" @ok="submit" no-fade>
    <b-row>
      <b-col>
        <b-form-group label="รหัสผ่านเดิม">
          <b-form-input type="password" name="password" v-model="password"></b-form-input>
        </b-form-group>
      </b-col>
    </b-row>
    <b-row>
      <b-col>
        <b-form-group label="รหัสผ่านใหม่">
          <b-form-input type="password" name="new_password" v-model="new_password"></b-form-input>
        </b-form-group>
      </b-col>
    </b-row>
    <b-row>
      <b-col>
        <b-form-group label="ยืนยันรหัสผ่านใหม่">
          <b-form-input
            type="password"
            name="new_password_confirmation"
            v-model="new_password_confirmation"
          ></b-form-input>
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
            password: "",
            new_password: "",
            new_password_confirmation: ""
        };
    },
    computed: {
        ...mapState(["user"])
    },
    methods: {
        show() {
            this.$refs.modal.show();
        },
        submit(e) {
            e.preventDefault();
            const payload = new FormData();
            payload.append("password", this.password);
            payload.append("new_password", this.new_password);
            payload.append(
                "new_password_confirmation",
                this.new_password_confirmation
            );
            axios
                .post("/api/user/password", payload)
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
