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
								<img src="/assets_admin/img/user/user-13.jpg" alt="" />
							</div>
							<div class="info">
								<b class="caret pull-right"></b>
								Sean Ngu
								<small>Front end developer</small>
							</div>
						</a>
					</li>
					<li>
						<ul class="nav nav-profile">
                            <li><a href="javascript:;"><i class="fa fa-cog"></i> Settings</a></li>
                            <li><a href="javascript:;"><i class="fa fa-pencil-alt"></i> Send Feedback</a></li>
                            <li><a href="javascript:;"><i class="fa fa-question-circle"></i> Helps</a></li>
                        </ul>
					</li>
				</ul>
				<!-- end sidebar user -->
				<!-- begin sidebar nav -->
				<ul class="nav">
					<li class="nav-header">Navigation</li>
					<li v-for="(menu, i) in menus" :key="i" :class="{'has-sub':menu.submenu !== undefined, 'active':checkActive(menu.url, 1)}">
						<router-link :to="menu.url">
					        <b class="caret" v-if="menu.caret"></b>
							<span class="badge pull-right" v-if="menu.badge !== undefined">{{ menu.badge }}</span>
							<div class="icon-img" v-if="menu.img !== undefined">
						    	<img :src="menu.img" alt="" />
						    </div>
						    <i v-if="menu.icon !== undefined" :class="menu.icon"></i>
						    <span>{{ menu.title }} <span class="label label-theme m-l-5" v-if="menu.label">{{ menu.label }}</span></span>
						</router-link>
						<ul class="sub-menu" v-if="menu.submenu !== undefined">
						    <li v-for="(sublv1, i) in menu.submenu" :key="i" :class="{'has-sub':sublv1.submenu !== undefined, 'active':checkActive(sublv1.url, 2)}">
								<router-link :to="sublv1.url">
									<b class="caret" v-if="sublv1.caret"></b>
									{{ sublv1.title }}
								</router-link>
								<ul class="sub-menu" v-if="sublv1.submenu !== undefined">
									<li v-for="(sublv2, i) in sublv1.submenu" :key="i" :class="{'has-sub':sublv2.submenu !== undefined, 'active':checkActive(sublv2.url, 3)}">
										<router-link :to="sublv2.url">
										    <b class="caret" v-if="sublv2.caret"></b>
										    {{ sublv2.title }}
										</router-link>
										<ul class="sub-menu" v-if="sublv2.submenu !== undefined">
											<li v-for="(sublv3, i) in sublv2.submenu" :key="i" :class="{'active':checkActive(sublv3.url, 4)}">
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
				'url': 'admin',
				'caret': true,
				'submenu': [{
					'url': 'dashboard/v1',
					'title': 'Dashboard v1'
				},{
					'url': 'dashboard/v2',
					'title': 'Dashboard v2'
				}]
			},{
				'icon': 'fa fa-hdd',
				'title': 'Email',
				'url': '',
				'badge': '10',
				'submenu': [{
					'url': 'email/inbox',
					'title': 'Inbox'
				},{
					'url': 'email/compose',
					'title': 'Compose'
				},{
					'url': 'email/detail',
					'title': 'Detail'
				}]
			},{
				'icon': 'fa fa-gem',
				'title': 'UI Elements',
				'url': '',
				'label': 'NEW',
				'caret': true,
				'submenu': [{
					'url': 'ui/general',
					'title': 'General'
				},{
					'url': 'ui/typography',
					'title': 'Typography'
				},{
					'url': 'ui/tabs-accordions',
					'title': 'Tabs & Accordions'
				},{
					'url': 'ui/modal-notification',
					'title': 'Modal & Notification',
					'highlight': true
				},{
					'url': 'ui/widget-boxes',
					'title': 'Widget Boxes'
				},{
					'url': 'ui/media-object',
					'title': 'Media Object'
				},{
					'url': 'ui/buttons',
					'title': 'Buttons'
				},{
					'url': 'ui/icons',
					'title': 'Icons'
				},{
					'url': 'ui/simple-line-icons',
					'title': 'Simple Line Ioncs'
				},{
					'url': 'ui/ionicons',
					'title': 'Ionicons'
				},{
					'url': 'ui/language-icon',
					'title': 'Language Icon'
				},{
					'url': 'ui/social-buttons',
					'title': 'Social Buttons'
				}]
			},{
				'img': '/assets_admin/img/logo/logo-bs4.png',
				'title': 'Bootstrap 4',
				'url': 'bootstrap-4',
				'label': 'NEW'
			},{
				'icon': 'fa fa-list-ol',
				'title': 'Form Stuff',
				'url': 'form-stuff'
			},{
				'icon': 'fa fa-table',
				'title': 'Tables',
				'url': 'tables'
			},{
				'icon': 'fa fa-star',
				'title': 'Frontend',
				'url': '',
				'caret': true,
				'submenu': [{
					'url': '',
					'title': 'One Page Parallax'
				},{
					'url': '',
					'title': 'Blog'
				},{
					'url': '',
					'title': 'Forum'
				},{
					'url': '',
					'title': 'E-Commerce'
				}]
			},{
				'icon': 'fa fa-chart-pie',
				'title': 'Chart',
				'url': '',
				'caret': true,
				'submenu': [{
					'url': 'chart/ngx',
					'title': 'Ngx Chart'
				},{
					'url': 'chart/d3',
					'title': 'd3 Chart'
				}]
			},{
				'icon': 'fa fa-calendar',
				'title': 'Calendar',
				'url': 'calendar'
			},{
				'icon': 'fa fa-map',
				'title': 'Map',
				'url': '/map'
			},{
				'icon': 'fa fa-image',
				'title': 'Gallery',
				'url': '',
				'caret': true,
				'submenu': [{
					'url': 'gallery/v1',
					'title': 'Gallery v1'
				},{
					'url': 'gallery/v2',
					'title': 'Gallery v2'
				}]
			},{
				'icon': 'fa fa-cogs',
				'title': 'Page Options',
				'url': '',
				'caret': true,
				'submenu': [{
					'url': 'page-option/page-blank',
					'title': 'Blank Page'
				},{
					'url': 'page-option/page-with-footer',
					'title': 'Page with Footer'
				},{
					'url': 'page-option/page-without-sidebar',
					'title': 'Page without Sidebar'
				},{
					'url': 'page-option/page-with-right-sidebar',
					'title': 'Page with Right Sidebar'
				},{
					'url': 'page-option/page-with-minified-sidebar',
					'title': 'Page with Minified Sidebar'
				},{
					'url': 'page-option/page-with-two-sidebar',
					'title': 'Page with Two Sidebar'
				},{
					'url': 'page-option/page-full-height',
					'title': 'Full Height Content'
				},{
					'url': 'page-option/page-with-wide-sidebar',
					'title': 'Page with Wide Sidebar'
				},{
					'url': 'page-option/page-with-light-sidebar',
					'title': 'Page with Light Sidebar'
				},{
					'url': 'page-option/page-with-top-menu',
					'title': 'Page with Top Menu'
				},{
					'url': 'page-option/page-with-mixed-menu',
					'title': 'Page with Mixed Menu'
				},{
					'url': 'page-option/page-with-transparent-sidebar',
					'title': 'Page with Transparent Sidebar'
				}]
			},{
				'icon': 'fa fa-gift',
				'title': 'Extra',
				'url': '',
				'caret': true,
				'submenu': [{
					'url': 'extra/timeline',
					'title': 'Timeline'
				},{
					'url': 'extra/coming-soon',
					'title': 'Coming Soon Page'
				},{
					'url': 'extra/search-results',
					'title': 'Search Results'
				},{
					'url': 'extra/invoice',
					'title': 'Invoice'
				},{
					'url': 'extra/error-page',
					'title': '404 Error Page'
				},{
					'url': 'extra/profile',
					'title': 'Profile Page'
				}]
			},{
				'icon': 'fa fa-key',
				'title': 'Login & Register',
				'url': '',
				'caret': true,
				'submenu': [{
					'url': 'login/v1',
					'title': 'Login'
				},{
					'url': 'login/v2',
					'title': 'Login v2'
				},{
					'url': 'login/v3',
					'title': 'Login v3'
				},{
					'url': 'register/v3',
					'title': 'Register v3'
				}]
			},{
				'icon': 'fa fa-cube',
				'title': 'Version',
				'url': '',
				'label': 'NEW',
				'caret': true,
				'submenu': [{
					'url': '',
					'title': 'HTML'
				},{
					'url': '',
					'title': 'AJAX'
				},{
					'url': '',
					'title': 'ANGULAR JS'
				},{
					'url': '',
					'title': 'ANGULAR JS 5'
				},{
					'url': '',
					'title': 'LARAVEL',
					'highlight': true
				},{
					'url': '',
					'title': 'MATERIAL DESIGN'
				},{
					'url': '',
					'title': 'APPLE DESIGN'
				},{
					'url': '',
					'title': 'TRANSPARENT DESIGN'
				}]
			},{
				'icon': 'fa fa-medkit',
				'title': 'Helper',
				'url': '',
				'caret': true,
				'submenu': [{
					'url': 'helper/css',
					'title': 'Predefined CSS Classes'
				}]
			},{
				'icon': 'fa fa-align-left',
				'title': 'Menu Level',
				'url': '',
				'caret': true,
				'submenu': [{
					'url': '',
					'title': 'Menu 1.1',
					'caret': true,
					'submenu': [{
						'url': '',
						'title': 'Menu 2.1',
						'caret': true,
						'submenu': [{
							'url': '',
							'title': 'Menu 3.1',
						},{
							'url': '',
							'title': 'Menu 3.2'
						}]
					},{
						'url': '',
						'title': 'Menu 2.2'
					},{
						'url': '',
						'title': 'Menu 2.3'
					}]
				},{
					'url': '',
					'title': 'Menu 1.2'
				},{
					'url': '',
					'title': 'Menu 1.3'
				}]
			}]

		};
	},
	methods: {
		checkActive(url, lv) {
			const segments = this.$route.path.split('/');
			const urlSegments = url.split('/');
			/**
			 * ถ้า url เป็น admin/dashboard/v1
			 * จะต้องตัด url ออกเป็น Segment แล้วเอามาเทียบกัน
			 * โดยจะต้องเหมือนกันทุก Segment
			 * สาเหตุที่ต้องเริ่มต้น i ด้วย 1 เพราะว่า
			 * ค่า this.$route.path จะได้ค่ามาเป็น /admin/dashboard/v1
			 * ถ้า split แล้ว index ที่ 1 ก็จะเป็น admin พอดี
			 */
			for(let i=1;i<=lv;i++) {
				if(urlSegments[i-1].indexOf(segments[i]) == -1) {
					return false;
				}
			}
			return true;
		}
	}
}
</script>

<style>

</style>
