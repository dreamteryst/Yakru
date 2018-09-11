<template>
    <section>
        <!-- begin login -->
        <div class="login login-v2" data-pageload-addclass="animated fadeIn">
            <!-- begin brand -->
            <div class="login-header">
                <div class="brand">
                    <router-link to="/">
                        <span class="logo" style="border: 0px;"><img
                            src="/assets/img/logo-small.png" width="30" height="30"></span><b>Yak</b>ru
                    </router-link>
                    <small>MOOC Via Live Streaming</small>
                </div>
                <div class="icon">
                    <i class="fa fa-lock"></i>
                </div>
            </div>
            <!-- end brand -->
            <!-- begin login-content -->
            <div class="login-content">
                <form action="index.html" method="GET" class="margin-bottom-0">
                    <div class="form-group m-b-20">
                        <input type="text" class="form-control form-control-lg" :class="{'is-invalid':isError('firstname')}" v-model="data.firstname" placeholder="Firstname" required />
                        <div class="invalid-feedback" v-if="isError('firstname')">
                            {{ errors.firstname[0] }}
                        </div>
                    </div>
                    <div class="form-group m-b-20">
                        <input type="text" class="form-control form-control-lg" :class="{'is-invalid':isError('lastname')}" v-model="data.lastname" placeholder="Lastname" required />
                        <div class="invalid-feedback" v-if="isError('lastname')">
                            {{ errors.lastname[0] }}
                        </div>
                    </div>
                    <div class="form-group m-b-20">
                        <input type="email" class="form-control form-control-lg" :class="{'is-invalid':isError('email')}" v-model="data.email" placeholder="Email Address" required />
                        <div class="invalid-feedback" v-if="isError('email')">
                            {{ errors.email[0] }}
                        </div>
                    </div>
                    <div class="form-group m-b-20">
                        <input type="password" class="form-control form-control-lg" :class="{'is-invalid':isError('password')}" v-model="data.password" placeholder="Password" required />
                        <div class="invalid-feedback" v-if="isError('password')">
                            {{ errors.password[0] }}
                        </div>
                    </div>
                    <div class="form-group m-b-20">
                        <input type="password" class="form-control form-control-lg" :class="{'is-invalid':isError('password_confirmation')}" v-model="data.password_confirmation" placeholder="Password Confirm" required />
                        <div class="invalid-feedback" v-if="isError('password_confirmation')">
                            {{ errors.password_confirmation[0] }}
                        </div>
                    </div>
                    <div class="login-buttons">
                        <button type="button" class="btn btn-success btn-block btn-lg" @click="register()">Register</button>
                    </div>
                    <div class="m-t-20">
                        Already a member yet? Click <router-link to="/auth">here</router-link> to login.
                    </div>
                </form>
            </div>
            <!-- end login-content -->
        </div>
        <!-- end login -->
    </section>
</template>

<script>
export default {
    data: () => ({
        data: {
            firstname: '',
            lastname: '',
            email: '',
            password: '',
            password_confirmation: ''
        },
        errors: []
    }),
    methods: {
        register() {
            const formData = new FormData();
            formData.append('firstname', this.data.firstname);
            formData.append('lastname', this.data.lastname);
            formData.append('email', this.data.email);
            formData.append('password', this.data.password);
            formData.append('password_confirmation', this.data.password_confirmation);
            axios.post(`//${window.location.host}/api/register`, formData)
            .then((res) => {
                if(res.status === 200)
                {
                    windows.location.href = '/';
                }
            })
            .catch((err) => {
                this.errors = err.response.data.errors;
                console.log(err.response);
            });
        },
        isError(field){
            return this.errors[field] !== undefined;
        }
    }
}
</script>

<style>

</style>
