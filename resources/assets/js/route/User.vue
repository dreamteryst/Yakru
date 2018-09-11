<template>
    <div>
        <Header/>
        <transition name="fade">
            <router-view></router-view>
        </transition>
        <Footer/>
    </div>
</template>

<style>
    .fade-enter-active, .fade-leave-active {
      transition: opacity .5s
    }
    .fade-enter, .fade-leave-active {
      opacity: 0
    }
</style>

<script>
import Navbar from '../components/layouts/Navbar.vue'
import Header from '../components/layouts/Header.vue'
import Footer from '../components/layouts/Footer.vue'
export default{
    components: {
        Navbar,
        Header,
        Footer
    }
}
</script>