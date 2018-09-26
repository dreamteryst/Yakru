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
                <form action="/" method="POST" @submit="login" class="margin-bottom-0">
                    <div class="form-group m-b-20">
                        <input type="text" class="form-control form-control-lg" v-model="data.email" placeholder="Email Address" required />
                    </div>
                    <div class="form-group m-b-20">
                        <input type="password" class="form-control form-control-lg" v-model="data.password" placeholder="Password" required />
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
export default {
    data: () => ({
        data: {
            email: '',
            password: '',
            remember: false
        },
        errors: []
    }),
    methods: {
        login(e) {
            e.preventDefault();
            const formData = new FormData();
            formData.append('email', this.data.email);
            formData.append('password', this.data.password);
            formData.append('remember', this.data.remember);

            axios.post(`${window.location.host}/api/login`, formData)
            .then((res) => {
                if(res.status === 200) {
                    window.location.href = '/';
                }
            })
            .catch((err) => {
                this.errors = err.response.data.errros;
                console.log(err.response);
            });
        }
    }

}
</script>

<style>

</style>
