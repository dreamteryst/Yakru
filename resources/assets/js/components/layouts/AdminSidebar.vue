<template>
    <section>
        <!-- begin #sidebar -->
		<div id="sidebar" class="sidebar">
			<!-- begin sidebar scrollbar -->
			<div data-scrollbar="true" data-height="100%">
				<!-- begin sidebar user -->
				<ul class="nav">
					<li class="nav-profile">
						<a href="javascript:;" data-toggle="nav-profile">
							<div class="cover with-shadow"></div>
							<div class="image">
								<img src="/assets_admin/img/user/user.jpg" alt="" />
							</div>
							<div class="info">
								<b class="caret pull-right"></b>
								DreaMTeryST
								<small>Full stack developer</small>
							</div>
						</a>
					</li>
					<li>
						<ul class="nav nav-profile">
                            <li><a href="javascript:;"><i class="fa fa-user"></i> Profile</a></li>
                            <li><a href="javascript:;"><i class="fa fa-power-off"></i> Logout</a></li>
                        </ul>
					</li>
				</ul>
				<!-- end sidebar user -->
				<!-- begin sidebar nav -->
				<ul class="nav">
					<li class="nav-header">Navigation</li>
					<li v-for="(menu, i) in menus" :key="i" :class="{'has-sub':isNotEmpty(menu.submenu), 'active':checkActive(menu)}">
						<router-link :to="menu.url">
					        <b class="caret" v-if="menu.caret"></b>
							<span class="badge pull-right" v-if="isNotEmpty(menu.badge)">{{ menu.badge }}</span>
							<div class="icon-img" v-if="isNotEmpty(menu.img)">
						    	<img :src="menu.img" alt="" />
						    </div>
						    <i v-if="isNotEmpty(menu.icon)" :class="menu.icon"></i>
						    <span>{{ menu.title }} <span class="label label-theme m-l-5" v-if="menu.label">{{ menu.label }}</span></span>
						</router-link>
						<ul class="sub-menu" v-if="isNotEmpty(menu.submenu)">
						    <li v-for="(sublv1, i) in menu.submenu" :key="i" :class="{'has-sub':isNotEmpty(sublv1.submenu), 'active':checkActive(sublv1)}">
								<router-link :to="sublv1.url">
									<b class="caret" v-if="sublv1.caret"></b>
									{{ sublv1.title }}
								</router-link>
								<ul class="sub-menu" v-if="isNotEmpty(sublv1.submenu)">
									<li v-for="(sublv2, i) in sublv1.submenu" :key="i" :class="{'has-sub':isNotEmpty(sublv2.submenu), 'active':checkActive(sublv2)}">
										<router-link :to="sublv2.url">
										    <b class="caret" v-if="sublv2.caret"></b>
										    {{ sublv2.title }}
										</router-link>
										<ul class="sub-menu" v-if="isNotEmpty(sublv2.submenu)">
											<li v-for="(sublv3, i) in sublv2.submenu" :key="i" :class="{'active':checkActive(sublv3)}">
												<a :to="sublv3.url">{{ sublv3.title }}</a>
											</li>
										</ul>
									</li>
								</ul>
							</li>
						</ul>
					</li>
					<!-- begin sidebar minify button -->
					<li><a href="javascript:;" class="sidebar-minify-btn" data-click="sidebar-minify"><i class="fa fa-angle-double-left"></i></a></li>
			        <!-- end sidebar minify button -->
				</ul>
				<!-- end sidebar nav -->
			</div>
			<!-- end sidebar scrollbar -->
		</div>
		<div class="sidebar-bg"></div>
		<!-- end #sidebar -->
    </section>
</template>

<script>
export default {
	data() {
		return {
			menus : [{
				'icon': 'fa fa-th-large',
				'title': 'Dashboard',
				'url': '/admin'
			},{
				'icon': 'fa fa-shopping-cart',
				'title': 'Order',
				'url': '/admin/order'
			},{
				'icon': 'fa fa-graduation-cap',
				'title': 'Course',
				'caret': true,
				'url': '',
				'submenu': [
					{
						'url': '/admin/course/add',
						'title': 'Add course'
					},
					{
						'url': '/admin/course',
						'title': 'Mange course'
					}
				]
			},{
				'icon': 'fa fa-credit-card',
				'title': 'Payment',
				'url': '/admin/payment'
			},{
				'icon': 'fa fa-users',
				'title': 'User',
				'url': '/admin/user'
			},{
				'icon': 'fa fa-cog',
				'title': 'Setting',
				'url': '/admin/setting'
			}]

		};
	},
	mounted() {

	},
	methods: {
		checkActive(menu) {
			// ถ้าเป็น submenu จะเป็น Array
			if(Array.isArray(menu)) {
				// ใช้ isActive เพราะใน forEach return ไม่ออก
				let isActive = false;
				menu.forEach((item) => {
					// ต้องเช็คด้วยว่าใน submenu มี submenu อีกหรือเปล่า
					if(this.isNotEmpty(item.submenu))
					{
						isActive = this.checkActive(item.submenu);
					} else if(item.url == this.$route.path) {
						isActive = true;
					}
				});
				return isActive;
			} else {
				if(this.isNotEmpty(menu.submenu))
				{
					return this.checkActive(menu.submenu);
				} else if(menu.url == this.$route.path) {
					return true; 
				}
			}
			return false;
		},
		isNotEmpty(item) {
			if(item !== undefined && item !== '' && item !== 0 && item !== null) {
				return true;
			}
			return false;
		}
	}
}
</script>

<style>

</style>
