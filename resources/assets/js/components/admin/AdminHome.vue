<template>
	<section>
		<h1 class="page-header">
			Quick access
			<small>เมนูเข้าถึงด่วน</small>
		</h1>
		<hr class="bg-grey-lighter" />
		<div class="row">
			<div v-for="(menu, i) in menus" :key="i" class="col-md-3 m-t-15" align="center">
				<div class="menu-box">
					<router-link :to="menu.link">
						<i :class="menu.icon"></i>
					</router-link>
				</div>
				<div class="m-t-15">
					<router-link :to="menu.link" class="text-medium f-s-15">{{ menu.name }}</router-link>
				</div>
			</div>
		</div>
	</section>
</template>

<script>
export default {
	data() {
		return {
			menus: [{
				icon: 'fas fa-layer-group',
				name: 'จัดการหมวดหมู่',
				link: '/admin/api/category'
			}, {
				icon: 'fas fa-book',
				name: 'จัดการคอร์ส',
				link: '/admin/api/course'
			}, {
				icon: 'fas fa-users',
				name: 'รายชื่อผู้เรียน',
				link: '/admin/api/student'
			}, {
				icon: 'fas fa-cogs',
				name: 'Settings',
				link: '/admin/api/settings'
			}]
		}
	}
};
</script>

<style>
</style>
