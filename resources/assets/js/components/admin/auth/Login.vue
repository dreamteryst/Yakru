<template>
    <section>
        <!-- begin login -->
        <div class="login login-v2" data-pageload-addclass="animated fadeIn">
            <!-- begin brand -->
            <div class="login-header">
                <div class="brand">
                    <a href="/">
                        <span class="logo" style="border: 0px;"><img
                            src="/assets/img/logo-small.png" width="30" height="30"></span><b>Yak</b>ru
                    </a>
                    <small>MOOC Via Live Streaming</small>
                </div>
                <div class="icon">
                    <i class="fa fa-lock"></i>
                </div>
            </div>
            <!-- end brand -->
            <!-- begin login-content -->
            <div class="login-content">
                <form action="/" method="POST" @submit="submitLogin" class="margin-bottom-0">
                    <div class="alert alert-danger" role="alert" v-if="isNotEmpty(error_message)">
                        {{ error_message }}
                    </div>
                    <div class="form-group m-b-20">
                        <input type="text" class="form-control form-control-lg" :class="{'is-invalid':isError(errors, 'email')}" v-model="data.email" placeholder="Email Address" required />
                        <div class="invalid-feedback" v-if="isError(errors, 'email')">
                            {{ errors.email[0] }}
                        </div>
                    </div>
                    <div class="form-group m-b-20">
                        <input type="password" class="form-control form-control-lg" :class="{'is-invalid':isError(errors, 'password')}" v-model="data.password" placeholder="Password" required />
                        <div class="invalid-feedback" v-if="isError(errors, 'password')">
                            {{ errors.password[0] }}
                        </div>
                    </div>
                    <div class="checkbox checkbox-css m-b-20">
                        <input type="checkbox" id="remember_checkbox" v-model="data.remember" />
                        <label for="remember_checkbox">
                            Remember Me
                        </label>
                    </div>
                    <div class="login-buttons">
                        <button type="submit" class="btn btn-success btn-block btn-lg">Sign me in</button>
                    </div>
                    <div class="m-t-20">
                        Not a member yet? Click <router-link to="/auth/register">here</router-link> to register.
                    </div>
                </form>
            </div>
            <!-- end login-content -->
        </div>
        <!-- end login -->
    </section>
</template>

<script>
import { mapMutations } from 'vuex';
export default {
    data: () => ({
        data: {
            email: "",
            password: "",
            remember: false
        },
        errors: {},
        error_message: ''
    }),
    methods: {
        ...mapMutations('auth', ['login']),
        submitLogin(e) {
            e.preventDefault();
            const formData = new FormData();
            formData.append("email", this.data.email);
            formData.append("password", this.data.password);
            formData.append("remember", this.data.remember);

            axios
                .post("/admin/login", formData)
                .then(res => {
                    if (res.status === 200) {
                        this.login()
                        window.location.href = "/";
                    }
                })
                .catch(({ response }) => {
                    this.error_message = response.data.message;
                    if (this.isNotEmpty(response.data.errors))
                        this.errors = response.data.errors;
                });
        }
    }
};
</script>

<style>
</style>
