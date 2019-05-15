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
								<img src="/assets_admin/img/user/personal.png" alt="" />
							</div>
								<div class="info">
									<b class="caret pull-right"></b>
									{{ user.firstname }} {{ user.lastname }}
									<small>{{ ucfirst(user.type || '') }}</small>
								</div>
						</a>
					</li>
					<li>
						<ul class="nav nav-profile">
							<li><a href="javascript:;"><i class="fa fa-user"></i> Profile</a></li>
							<li><a href="/admin/logout"><i class="fa fa-power-off"></i> Logout</a></li>
						</ul>
					</li>
				</ul>
				<!-- end sidebar user -->
				<!-- begin sidebar nav -->
				<ul class="nav">
					<li class="nav-header">Navigation</li>
					<li v-for="(menu, i) in menus" :key="i" 
						:class="{'has-sub':isNotEmpty(menu.submenu), 'active':checkActive(menu)}"
						v-show="menu.for.includes(user.type)"
					>
						<router-link :to="menu.url">
							<b class="caret" v-if="menu.caret"></b>
							<span class="badge pull-right" v-if="isNotEmpty(menu.badge)">{{ menu.badge }}</span>
							<div class="icon-img" v-if="isNotEmpty(menu.img)">
								<img :src="menu.img" alt="" />
						    </div>
								<i v-if="isNotEmpty(menu.icon)" :class="menu.icon"></i>
								<span>{{ menu.title }} <span class="label label-theme m-l-5" v-if="isNotEmpty(menu.label)">{{ menu.label }}</span></span>
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
												<router-link :to="sublv3.url">{{ sublv3.title }}</router-link>
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
import { mapState } from 'vuex';
export default {
	computed: {
		...mapState(['user'])
	},
	data() {
		return {
			menus: [{
				'icon': 'fa fa-home',
				'title': 'หน้าแรก',
				'url': '/admin',
				'for': ['teacher', 'admin']
			}, {
				'icon': 'fa fa-shopping-cart',
				'title': 'รายการซื้อขาย',
				'url': '/admin/order',
				'for': ['teacher', 'admin']
			}, {
				'icon': 'fa fa-book',
				'title': 'หมวดหมู่',
				'url': '',
				'for': ['admin'],
				'caret': true,
				'submenu': [
					{
						'url': '/admin/category/add',
						'title': 'เพิ่มหมวดหมู่'
					},
					{
						'url': '/admin/category',
						'title': 'จัดการหมวดหมู่'
					}
				]
			}, {
				'icon': 'fa fa-graduation-cap',
				'title': 'คอร์ส',
				'caret': true,
				'url': '',
				'for': ['teacher', 'admin'],
				'submenu': [
					{
						'url': '/admin/course/add',
						'title': 'เพิ่มคอร์ส'
					},
					{
						'url': '/admin/course',
						'title': 'จัดการคอร์ส'
					}
				]
			}, {
				'icon': 'fas fa-award',
				'title': 'โปรโมชัน',
				'caret': true,
				'url': '',
				'for': [],
				'submenu': [
					{
						'url': '/admin/promotion/add',
						'title': 'เพิ่มโปรโมชัน'
					}, {
						'url': '/admin/promotion',
						'title': 'จัดการโปรโมชัน'
					}
				]
			}, {
				'icon': 'fa fa-undo-alt',
				'title': 'รายการคำขอคืนเงิน',
				'url': '/admin/course/refund',
				'for': ['admin']
			}, {
				'icon': 'fa fa-credit-card',
				'title': 'รายการแจ้งชำระเงิน',
				'url': '/admin/payment',
				'for': ['admin']
			}, {
				'icon': 'fa fa-coins',
				'title': 'รายการเติมเงิน',
				'url': '/admin/topup',
				'for': ['admin']
			}, {
				'icon': 'fas fa-address-card',
				'title': 'ข้อมูลผู้สมัครเป็นผู้สอน',
				'url': '/admin/teacher/register',
				'for': ['admin']
			}, {
				'icon': 'fa fa-users',
				'title': 'ผู้ใช้งาน',
				'url': '',
				'for': ['admin'],
				'caret': true,
				'submenu': [{
					'url': '/admin/student',
					'title': ' รายชื่อผู้เรียน'
				}, {
					'url': '/admin/teacher',
					'title': 'รายชื่อผู้สอน'
				}]
			}]
		};
	},
	mounted() {
		// check nav item collapse
		$('.nav>li>a').on('click', function () {
			$('.nav>li:not(.expand,.expanding)').each((key, item) => {
				$(item).find('ul:not(.nav-profile)').slideUp();
			});
		});
	},
	methods: {
		checkActive(menu) {
			// ถ้าเป็น submenu จะเป็น Array
			if (Array.isArray(menu)) {
				// ใช้ isActive เพราะใน forEach return ไม่ออก
				let isActive = false;
				menu.forEach((item) => {
					// ต้องเช็คด้วยว่าใน submenu มี submenu อีกหรือเปล่า
					if (this.isNotEmpty(item.submenu)) {
						isActive = this.checkActive(item.submenu);
					} else if (item.url == this.$route.path) {
						isActive = true;
					}
				});
				return isActive;
			} else {
				if (this.isNotEmpty(menu.submenu)) {
					return this.checkActive(menu.submenu);
				} else if (menu.url == this.$route.path) {
					return true;
				}
			}
			return false;
		},
		isNotEmpty(item) {
			if (item !== undefined && item !== '' && item !== 0 && item !== null) {
				return true;
			}
			return false;
		}
	}
}
</script>

<style>
</style>
