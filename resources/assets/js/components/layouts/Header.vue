<template>
    <section>
        <!-- BEGIN #header -->
        <div id="header" class="header">
            <!-- BEGIN container -->
            <div class="container">
                <!-- BEGIN header-container -->
                <div class="header-container">
                    <!-- BEGIN navbar-header -->
                    <div class="navbar-header">
                        <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar-collapse">
                            <span class="icon-bar"></span>
                            <span class="icon-bar"></span>
                            <span class="icon-bar"></span>
                        </button>
                        <div class="header-logo">
                            <router-link to="/">
                                <span class="brand-logo" style="border: 0px;"><img
                                src="/assets/img/logo-small.png" width="30" height="30"></span>
                                <span>Yak</span>ru
                                <small>MOOC Via Live Streaming</small>
                            </router-link>
                        </div>
                    </div>
                    <!-- END navbar-header -->
                    <!-- BEGIN header-nav -->
                    <div class="header-nav">
                        <div class=" collapse navbar-collapse" id="navbar-collapse">
                            <ul class="nav">
                                <li class="active"><a href="/">หน้าแรก</a></li>
                                <!-- <li class="dropdown dropdown-hover">
                                    <a href="#" data-toggle="dropdown">
                                        Accessories 
                                        <i class="fa fa-angle-down"></i> 
                                        <span class="arrow top"></span>
                                    </a>
                                    <ul class="dropdown-menu">
                                        <li><a href="product.html">Mobile Phone</a></li>
                                        <li><a href="product.html">Tablet</a></li>
                                        <li><a href="product.html">TV</a></li>
                                        <li><a href="product.html">Desktop</a></li>
                                        <li><a href="product.html">Laptop</a></li>
                                        <li><a href="product.html">Speaker</a></li>
                                        <li><a href="product.html">Gadget</a></li>
                                    </ul>
                                </li> -->
                                <li><a href="product.html">คอร์สออนไลน์</a></li>
                                <li><a href="product.html">แจ้งชำระเงิน</a></li>
                                <li><a href="#">สมัครเป็นผู้สอน</a></li>
                                <li><router-link to="contact">ติดต่อเรา</router-link></li>
                                <li class="dropdown dropdown-hover">
                                    <a href="#" data-toggle="dropdown">
                                        <i class="fa fa-search search-btn"></i>
                                        <span class="arrow top"></span>
                                    </a>
                                    <div class="dropdown-menu p-15">
                                        <form action="search_results.html" method="POST" name="search_form">
                                            <div class="input-group">
                                                <input type="text" placeholder="Search" class="form-control bg-silver-lighter" />
                                                <span class="input-group-btn">
                                                    <button class="btn btn-inverse" type="submit"><i class="fa fa-search"></i></button>
                                                </span>
                                            </div>
                                        </form>
                                    </div> 
                                </li>
                            </ul>
                        </div>
                    </div>
                    <!-- END header-nav -->
                    <!-- BEGIN header-nav -->
                    <div class="header-nav">
                        <ul class="nav pull-right">
                            <li class="dropdown dropdown-hover">
                                <a href="#" class="header-cart" data-toggle="dropdown">
                                    <i class="fa fa-shopping-bag"></i>
                                    <span class="total">1</span>
                                    <span class="arrow top"></span>
                                </a>
                    
                                <div class="dropdown-menu dropdown-menu-cart p-0">
                                    <div class="cart-header">
                                        <h4 class="cart-title">ตะกร้าของคุณ (1) </h4>
                                    </div>
                                    <div class="cart-body">
                                        <ul class="cart-item">
                                            <li>
                                                <div class="cart-item-image"><img src="/assets/img/product/react-native-cover.jpg" alt="" /></div>
                                                <div class="cart-item-info">
                                                    <h4>React Native สำหรับมือใหม่!!</h4>
                                                    <p class="price">฿330.00</p>
                                                </div>
                                                <div class="cart-item-close">
                                                    <a href="#" data-toggle="tooltip" data-title="Remove">&times;</a>
                                                </div>
                                            </li>
                                        </ul>
                                    </div>
                                    <div class="cart-footer">
                                        <div class="row row-space-10">
                                            <div class="col-xs-12">
                                                <router-link to="checkout_cart" class="btn btn-inverse btn-block">ดูตะกร้าสินค้า</router-link>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </li>
                            <li class="divider"></li>
                            <li>
                                <router-link to="/" v-if="isAuth">
                                    <img src="/assets/img/user/user-1.jpg" class="user-img" alt="" /> 
                                    <span class="hidden-md hidden-sm hidden-xs">{{ profile.firstname }} {{ profile.lastname }}</span>
                                </router-link>
                                <router-link to="/auth" v-if="!isAuth">
                                    <span class="hidden-md hidden-sm hidden-xs">เข้าสู่ระบบ / สมัครสมาชิก</span>
                                </router-link>
                            </li>
                        </ul>
                    </div>
                    <!-- END header-nav -->
                </div>
                <!-- END header-container -->
            </div>
            <!-- END container -->
        </div>
        <!-- END #header -->
    </section>
</template>

<script>
import { mapState } from 'vuex';
export default {
    data() {
        return {
            profile: {}
        }
    },
    computed: {
        ...mapState(['user']),
        ...mapState('auth',['isAuth'])
    },
    watch: {
        user() {
            this.profile = this.user
        }
    },
    mounted() {
        console.log(this.isAuth)
    }
};
</script>
