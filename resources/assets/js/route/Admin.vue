<template>
    <div>
        <admin-header/>
        <admin-sidebar/>
        <div id="content" class="content">
            <transition name="fade">
                <router-view></router-view>
            </transition>
        </div>
        <admin-footer/>
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
import AdminHeader from '../components/layouts/AdminHeader.vue'
import AdminSidebar from '../components/layouts/AdminSidebar.vue'
import AdminFooter from '../components/layouts/AdminFooter.vue'
export default{
    components: {
        AdminHeader,
        AdminSidebar,
        AdminFooter
    }
}
</script>