<template>
    <section>
        <!-- begin login -->
        <div class="login login-v2" data-pageload-addclass="animated fadeIn">
            <!-- begin brand -->
            <div class="login-header">
                <div class="brand">
                    <router-link to="/">
                        <span class="brand-logo" style="border: 0px;"><img
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
                        <input type="text" class="form-control form-control-lg" placeholder="Firstname" required />
                    </div>
                    <div class="form-group m-b-20">
                        <input type="text" class="form-control form-control-lg" placeholder="Lastname" required />
                    </div>
                    <div class="form-group m-b-20">
                        <input type="text" class="form-control form-control-lg" placeholder="Email Address" required />
                    </div>
                    <div class="form-group m-b-20">
                        <input type="password" class="form-control form-control-lg" placeholder="Password" required />
                    </div>
                    <div class="form-group m-b-20">
                        <input type="password" class="form-control form-control-lg" placeholder="Password Confirm" required />
                    </div>
                    <div class="checkbox checkbox-css m-b-20">
                        <input type="checkbox" id="remember_checkbox" /> 
                        <label for="remember_checkbox">
                        	Remember Me
                        </label>
                    </div>
                    <div class="login-buttons">
                        <button type="submit" class="btn btn-success btn-block btn-lg">Sign me in</button>
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

}
</script>

<style>

</style>
