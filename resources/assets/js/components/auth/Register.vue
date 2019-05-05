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
                <form action="/" method="POST" @submit="register" class="margin-bottom-0">
                    <div class="form-group m-b-20">
                        <input type="text" class="form-control form-control-lg" :class="{'is-invalid':isError(errors, 'firstname')}" v-model="data.firstname" placeholder="ชื่อจริง" required />
                        <div class="invalid-feedback" v-if="isError(errors, 'firstname')">
                            {{ errors.firstname[0] }}
                        </div>
                    </div>
                    <div class="form-group m-b-20">
                        <input type="text" class="form-control form-control-lg" :class="{'is-invalid':isError(errors, 'lastname')}" v-model="data.lastname" placeholder="นามสกุล" required />
                        <div class="invalid-feedback" v-if="isError(errors, 'lastname')">
                            {{ errors.lastname[0] }}
                        </div>
                    </div>
                    <div class="form-group m-b-20">
                        <input type="email" class="form-control form-control-lg" :class="{'is-invalid':isError(errors, 'email')}" v-model="data.email" placeholder="อีเมล" required />
                        <div class="invalid-feedback" v-if="isError(errors, 'email')">
                            {{ errors.email[0] }}
                        </div>
                    </div>
                    <div class="form-group m-b-20">
                        <input type="password" class="form-control form-control-lg" :class="{'is-invalid':isError(errors, 'password')}" v-model="data.password" placeholder="รหัสผ่าน" required />
                        <div class="invalid-feedback" v-if="isError(errors, 'password')">
                            {{ errors.password[0] }}
                        </div>
                    </div>
                    <div class="form-group m-b-20">
                        <input type="password" class="form-control form-control-lg" :class="{'is-invalid':isError(errors, 'password_confirmation')}" v-model="data.password_confirmation" placeholder="ยืนยันรหัสผ่าน" required />
                        <div class="invalid-feedback" v-if="isError(errors, 'password_confirmation')">
                            {{ errors.password_confirmation[0] }}
                        </div>
                    </div>
                    <div class="login-buttons">
                        <button type="submit" class="btn btn-success btn-block btn-lg">สมัครสมาชิก</button>
                    </div>
                    <div class="m-t-20">
                        เป็นสมาชิกอยู่แล้ว? คลิก <router-link to="/auth">ที่นี่</router-link> เพื่อเข้าสู่ระบบ
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
        register(e) {
            e.preventDefault();
            const formData = new FormData();
            formData.append('firstname', this.data.firstname);
            formData.append('lastname', this.data.lastname);
            formData.append('email', this.data.email);
            formData.append('password', this.data.password);
            formData.append('password_confirmation', this.data.password_confirmation);
            axios.post('/register', formData)
            .then((res) => {
                if(res.status === 200)
                {
                    window.location.href = '/';
                }
            })
            .catch((err) => {
                this.errors = err.response.data.errors;
                console.log(err.response);
            });
        }
    }
}
</script>

<style>

</style>
