<template>
    <section>
        <Navbar/>
        <Header/>
        <router-view></router-view>
        <Footer/>
    </section>
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
import Navbar from './components/layouts/Navbar.vue'
import Header from './components/layouts/Header.vue'
import Footer from './components/layouts/Footer.vue'
export default{
    components: {
        Navbar,
        Header,
        Footer
    }
}
</script>