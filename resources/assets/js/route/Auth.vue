<template>
    <div>
        <router-view></router-view>
        <auth-footer/>
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
import AuthFooter from '../components/layouts/AuthFooter.vue'
export default {
    components: {
        AuthFooter
    }
}
</script>