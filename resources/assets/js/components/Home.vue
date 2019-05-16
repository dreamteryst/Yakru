<template>
	<section>
		<!-- BEGIN #slider -->
		<div id="slider" class="section-container p-0 bg-black-darker">
			<!-- BEGIN carousel -->
			<div id="main-carousel" class="carousel slide" data-ride="carousel">
				<!-- BEGIN carousel-inner -->
				<div class="carousel-inner">
					<!-- BEGIN item -->
					<div class="item active">
						<img src="/assets/img/cover/carousel-1.jpg" class="bg-cover-img" alt="" />
						<div class="container">
							<img src="/assets/img/product/react-logo.png" class="product-img right bottom fadeInRight animated" alt="" />
						</div> 
						<div class="carousel-caption carousel-caption-left">
						<div class="container">
								<h3 class="title m-b-5 fadeInLeftBig animated">React Native</h3>
								<p class="m-b-15 fadeInLeftBig animated">Mobile Development.</p> 
								<div class="price m-b-30 fadeInLeftBig animated">
									<small>from</small>
									<span>฿2299.00</span>
								</div>
								<router-link to="/live-stream" class="btn btn-outline btn-lg fadeInLeftBig animated">Buy Now</router-link>
							</div>
						</div>
					</div>
					<!-- END item -->
					<!-- BEGIN item -->
					<div class="item">
						<img src="/assets/img/cover/react-cover.jpg" class="bg-cover-img" alt="" />
						<div class="container">
							<img src="/assets/img/cover/angular-logo.png" class="product-img left bottom fadeInLeft animated" alt="" />
						</div>
						<div class="carousel-caption carousel-caption-right">
							<div class="container">
								<h3 class="title m-b-5 fadeInRightBig animated">Angular 4</h3>
								<p class="m-b-15 fadeInRightBig animated">สอนใช้ Angular อย่างมืออาชีพ</p>
								<div class="price m-b-30 fadeInRightBig animated">
									<small>from</small>
									<span>฿1,149.00</span>
								</div>
								<router-link to="/live-stream" class="btn btn-outline btn-lg fadeInRightBig animated">Buy Now</router-link>
							</div>
						</div>
					</div>
					<!-- END item -->
				</div>
				<!-- END carousel-inner -->
				<a class="left carousel-control" href="#main-carousel" data-slide="prev">
					<i class="fa fa-angle-left"></i>
				</a>
				<a class="right carousel-control" href="#main-carousel" data-slide="next">
					<i class="fa fa-angle-right"></i>
				</a>
			</div>
			<!-- END carousel -->
		</div>
		<!-- END #slider -->

		<!-- BEGIN #Web Development -->
		<div id="Web Development" class="section-container bg-white" v-for="(category, i) in categories" :key="i">
			<!-- BEGIN container -->
			<div class="container">
				<!-- BEGIN section-title -->
				<h4 class="section-title clearfix">
					<a href="#" class="pull-right">SHOW ALL</a>
					{{ category.category_name }}
					<small>{{ category.category_description }}</small>
				</h4>
				<!-- END section-title -->

				<!-- BEGIN row -->
				<div class="row row-space-10">
					<!-- BEGIN col-2 -->
					<div class="col-md-2 col-sm-4" v-for="(course, j) in category.courses" :key="j" v-if="course.course_price">
						<!-- BEGIN item -->
						<div class="item item-thumbnail">
							<router-link :to="`/product-detail/${course.id}`" class="item-image">
								<img :src="renderPicture(course.course_picture)" alt="" />
								<div class="discount">{{ isNaN(getPercent(course)) ? 0 : getPercent(course) }}% OFF</div>
							</router-link>
							<div class="item-info">
								<h4 class="item-title">
									<router-link :to="`/product-detail/${course.id}`" v-html="course.course_name"></router-link>
								</h4>
								<p class="item-desc">{{ course.course_subtitle }}</p>
								<div class="item-price">฿ {{ course.final_price <= 0 ? 'FREE' : numberWithCommas(course.final_price) }}</div>
								<div class="item-discount-price">฿ {{ numberWithCommas(course.course_price) }}</div>
								<div class="live-text" v-if="course.type === 'live'">• Live</div>
								<div class="text-primary" v-else>Video</div>
							</div>
						</div>
						<!-- END item -->
					</div>
					<!-- END col-2 -->
				</div>
				<!-- END row -->
			</div>
			<!-- END container -->
		</div>
		<!-- END #Web Development -->

		<!-- BEGIN #subscribe -->
		<div id="subscribe" class="section-container bg-silver p-t-30 p-b-30">
			<!-- BEGIN container -->
			<div class="container">
				<!-- BEGIN row -->
				<div class="row">
					<!-- BEGIN col-6 -->
					<div class="col-md-6 col-sm-6">
						<!-- BEGIN subscription -->
						<div class="subscription">
							<div class="subscription-intro">
								<h4> LET'S STAY IN TOUCH</h4>
								<p>ติดตามคอร์สและโปรโมชันใหม่ ๆ ได้ที่นี่</p>
							</div>
							<div class="subscription-form">
								<form name="subscription_form" action="index.html" method="POST">
									<div class="input-group">
										<input type="text" class="form-control" name="email" placeholder="Enter Email Address" />
										<div class="input-group-btn">
											<button type="submit" class="btn btn-inverse">
												<i class="fa fa-angle-right"></i>
											</button>
										</div>
									</div>
								</form>
							</div>
						</div>
						<!-- END subscription -->
					</div>
					<!-- END col-6 -->
					<!-- BEGIN col-6 -->
					<div class="col-md-6 col-sm-6">
						<!-- BEGIN social -->
						<div class="social">
							<div class="social-intro">
								<h4>FOLLOW US</h4>
							</div>
							<div class="social-list">
								<a href="#">
									<i class="fa fa-facebook"></i>
								</a>
								<a href="#">
									<i class="fa fa-twitter"></i>
								</a>
							</div>
						</div>
						<!-- END social -->
					</div>
					<!-- END col-6 -->
				</div>
				<!-- END row -->
			</div>
			<!-- END container -->
		</div>
		<!-- END #subscribe -->
	</section>
</template>

<script>
export default {
  data() {
    return {
      categories: [
        {
          name: "Web Develeopment",
          description: "",
          courses: [
            {
              img:
                "/assets/img/product/angular-cover.jpg",
              name: "Core Angular: การใช้งาน Angular 4",
              description:
                "สอนใช้ Angular 4 อย่างมืออาชีพ!",
              price: 330,
              discount: 7000
            },
            {
              img:
                "https://udemy-images.udemy.com/course/240x135/1042110_ffc3_3.jpg",
              name:
                "Beginner Full Stack Web Development: HTML, CSS, React & Node",
              description:
                "Learn web development with HTML, CSS, Bootstrap 4, ES6 React and Node",
              price: 330,
              discount: 7800
            },
            {
              img:
                "https://udemy-images.udemy.com/course/240x135/548278_b005_2.jpg",
              name: "The Complete Web Development Course - Build 15 Projects",
              description:
                "HTML, CSS, Javascript, jQuery, Bootstrap, PHP, MySQL, Wordpress, API's (Google , Facebook, Twitter), Mobile All covered!",
              price: 330,
              discount: 7800
            },
          ]
        },
        {
          name: "Mobile Develeopment",
          description: "",
          courses: [
            {
              img:
                "/assets/img/product/react-native-cover.jpg",
              name: "React Native<br/> สำหรับมือใหม่!!",
              description:
                "สอน React Native เบื้องต้น สำหรับมือใหม่!",
              price: 330,
              discount: 7800
            },
            {
              img:
                "https://udemy-images.udemy.com/course/240x135/959700_8bd2_9.jpg",
              name: "The Complete React Native and Redux Course",
              description:
                "iOS and Android App Development from scratch - build full React Native mobile apps ridiculously fast!",
              price: 330,
              discount: 3600
            },
						{
               img:
                 "https://udemy-images.udemy.com/course/240x135/1017096_0e3f_3.jpg",
               name:
                 "Mobile App Development for Beginners (Swift 3, iPhone iOS10)",
               description:
                 "iPhone (iOS 10) app development. The complete development course. Use Swift 3 & Xcode 8 to design 10 iPhone apps.",
               price: 330,
               discount: 1800
             }
          ]
        }
      ]
    };
  },
	mounted() {
		axios.get('/api/category').then(({data}) => {
			const categories = []
			data.map(item => {
				item.courses = item.courses.splice(0, 7)
				categories.push(item)
			})
			this.categories = categories
		}).catch(error => {
			console.log(error)
			if(error.response) console.log(error.response)
		});
	}
};
</script>

<style>
.pull-right-clear {
  float: right;
  line-height: 16px;
  margin: -7px 0;
  border-radius: 3px;
}
</style>

