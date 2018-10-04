<template>
    <section>
        <!-- begin #header -->
		<div id="header" class="header navbar-default">
			<!-- begin navbar-header -->
			<div class="navbar-header">
				<a href="/" class="navbar-brand">
					<span class="navbar-logo" style="border: 0px;margin-top: 0px;background-color: transparent;">
						<img src="/assets/img/logo-small.png" width="30" height="30">
					</span> <b>Yak</b>ru
				</a>
				<button type="button" class="navbar-toggle" data-click="sidebar-toggled">
					<span class="icon-bar"></span>
					<span class="icon-bar"></span>
					<span class="icon-bar"></span>
				</button>
			</div>
			<!-- end navbar-header -->
			<ul class="navbar-nav">
				<li v-for="(menu, i) in menus" :key="i">
					<router-link :to="menu.link"><i :class="menu.icon"></i> {{ menu.name }}</router-link>
				</li>
			</ul>
			
			<!-- begin header-nav -->
			<!-- <ul class="navbar-nav navbar-right">
				<li>
					<form class="navbar-form">
						<div class="form-group">
							<input type="text" class="form-control" placeholder="Enter keyword" />
							<button type="submit" class="btn btn-search"><i class="fa fa-search"></i></button>
						</div>
					</form>
				</li>
				<li class="dropdown navbar-user">
					<a href="javascript:;" class="dropdown-toggle" data-toggle="dropdown">
						<img src="/assets_admin/img/user/user.jpg" alt="" /> 
						<span class="d-none d-md-inline">Kittisak Pimnonthong</span> <b class="caret"></b>
					</a>
					<div class="dropdown-menu dropdown-menu-right">
						<a href="javascript:;" class="dropdown-item">Edit Profile</a>
						<a href="javascript:;" class="dropdown-item"><span class="badge badge-danger pull-right">2</span> Inbox</a>
						<a href="javascript:;" class="dropdown-item">Calendar</a>
						<a href="javascript:;" class="dropdown-item">Setting</a>
						<div class="dropdown-divider"></div>
						<a href="javascript:;" class="dropdown-item">Log Out</a>
					</div>
				</li>
			</ul> -->
			<!-- end header navigation right -->
		</div>
		<!-- end #header -->
    </section>
</template>

<script>
export default {
	data() {
		return {
			menus: [{
				icon: 'fas fa-layer-group',
				name: 'จัดการหมวดหมู่',
				link: '/admin/category'
			}, {
				icon: 'fas fa-book',
				name: 'จัดการคอร์ส',
				link: '/admin/course'
			}, {
				icon: 'fas fa-award',
				name: 'จัดการโปรโมชัน',
				link: 'admin/promotion'
			}, {
				icon: 'fas fa-users',
				name: 'รายชื่อผู้เรียน',
				link: '/admin/student'
			}, {
				icon: 'fas fa-cogs',
				name: 'ตั้งค่า',
				link: '/admin/settings'
			}]
		}
	}
}
</script>

<style>

</style>
