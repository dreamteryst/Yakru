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
						<img src="/assets/img/cover/react-cover.jpg" class="bg-cover-img" alt="" />
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
						<img src="/assets/img/cover/cover-5.jpg" class="bg-cover-img" alt="" />
						<div class="container">
							<img src="https://png.icons8.com/color/1600/c-programming.png" class="product-img left bottom fadeInLeft animated" alt="" />
						</div>
						<div class="carousel-caption carousel-caption-right">
							<div class="container">
								<h3 class="title m-b-5 fadeInRightBig animated">Microcontrollers</h3>
								<p class="m-b-15 fadeInRightBig animated">and the C Programming LanguageT</p>
								<div class="price m-b-30 fadeInRightBig animated">
									<small>from</small>
									<span>฿1,149.00</span>
								</div>
								<router-link to="/live-stream" class="btn btn-outline btn-lg fadeInRightBig animated">Buy Now</router-link>
							</div>
						</div>
					</div>
					<!-- END item -->
					<!-- BEGIN item -->
					<div class="item">
						<img src="/assets/img/cover/cover-9.jpg" class="bg-cover-img" alt="" />
						<div class="carousel-caption">
							<div class="container">
								<h3 class="title m-b-5 fadeInDownBig animated">Scratch Game</h3>
								<p class="m-b-15 fadeInDownBig animated">Programming for Young Adults</p>
								<div class="price fadeInDownBig animated">
									<small>from</small>
									<span>฿999.00</span>
								</div>
								<router-link to="/live-stream" class="btn btn-outline btn-lg fadeInUpBig animated">Buy Now</router-link>
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
		<div id="Web Development" class="section-container bg-silver" v-for="(category, i) in categories" :key="i">
			<!-- BEGIN container -->
			<div class="container">
				<!-- BEGIN section-title -->
				<h4 class="section-title clearfix">
					<a href="#" class="pull-right">SHOW ALL</a>
					{{ category.name }}
					<small>{{ category.description }}</small>
				</h4>
				<!-- END section-title -->

				<!-- BEGIN row -->
				<div class="row row-space-10">
					<!-- BEGIN col-2 -->
					<div class="col-md-2 col-sm-4" v-for="(course, j) in category.courses" :key="j">
						<!-- BEGIN item -->
						<div class="item item-thumbnail">
							<router-link to="/product-detail" class="item-image">
								<img :src="course.img" alt="" />
								<div class="discount">{{ getPercent(course) }}% OFF</div>
							</router-link>
							<div class="item-info">
								<h4 class="item-title">
									<router-link to="/product-detail">{{ course.name }}</router-link>
								</h4>
								<p class="item-desc">{{ course.description }}</p>
								<div class="item-price">฿ {{ numberWithCommas(course.price) }}</div>
								<div class="item-discount-price">฿ {{ numberWithCommas(course.discount) }}</div>
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
								<p>Get updates on sales specials and more</p>
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
								<p>We want to hear from you!</p>
							</div>
							<div class="social-list">
								<a href="#">
									<i class="fa fa-facebook"></i>
								</a>
								<a href="#">
									<i class="fa fa-twitter"></i>
								</a>
								<a href="#">
									<i class="fa fa-instagram"></i>
								</a>
								<a href="#">
									<i class="fa fa-dribbble"></i>
								</a>
								<a href="#">
									<i class="fa fa-google-plus"></i>
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
      trending: {
        name: "Trending Items",
        description: "Shop and get your favourite items at amazing prices!",
        courses: [
          {
            img:
              "https://udemy-images.udemy.com/course/240x135/1002676_3c6e_2.jpg",
            name: "The Full Stack Web Development",
            description:
              "Learn Full Stack Web Development Building Over 40+ Projects",
            price: 330,
            discount: 2200
          },
          {
            img:
              "https://udemy-images.udemy.com/course/240x135/917724_114b_12.jpg",
            name: "Learn JavaScript for Web Development",
            description:
              "Advance your Web Development Skills By Learning Javascript from JavaScript Expert",
            price: 330,
            discount: 2800
          },
          {
            img:
              "https://udemy-images.udemy.com/course/240x135/284076_749f_7.jpg",
            name: "Automate Web Development With Gulp JS",
            description:
              "Learn how to automate and speed up your web development.",
            price: 330,
            discount: 600
          },
          {
            img:
              "https://udemy-images.udemy.com/course/240x135/1512578_b4eb_2.jpg",
            name: "Android App Development: Mobile App Development & Java",
            description:
              "Android App Development & Java Programming: Mobile App Development & Design, Build Android Apps, Android 5 & Lollipop",
            price: 330,
            discount: 7200
          },
          {
            img:
              "https://udemy-images.udemy.com/course/240x135/200994_5de4_2.jpg",
            name: "Business Development For Startups and Tech Companies",
            description:
              "Unlock massive growth using the business development channel. Learn pitching, BD strategy, cold emailing, & deal closing",
            price: 330,
            discount: 7600
          },
          {
            img:
              "https://udemy-images.udemy.com/course/240x135/507714_f9f3_3.jpg",
            name: "Certificate in QlikSense Analytics Development",
            description:
              "Scenario based QlikSense app development training using real business data examples for visual data analysis",
            price: 330,
            discount: 6800
          }
        ]
      },
      categories: [
        {
          name: "Web Develeopment",
          description: "Shop and get your favourite items at amazing prices!",
          courses: [
            {
              img:
                "https://udemy-images.udemy.com/course/240x135/1254420_f6cb_4.jpg",
              name: "Node with React: Fullstack Web Development",
              description:
                "Build and deploy fullstack web apps with NodeJS, React, Redux, Express, and MongoDB.",
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
            {
              img:
                "https://udemy-images.udemy.com/course/240x135/1002676_3c6e_2.jpg",
              name: "The Full Stack Web Development",
              description:
                "Learn Full Stack Web Development Building Over 40+ Projects",
              price: 330,
              discount: 2200
            },
            {
              img:
                "https://udemy-images.udemy.com/course/240x135/917724_114b_12.jpg",
              name: "Learn JavaScript for Web Development",
              description:
                "Advance your Web Development Skills By Learning Javascript from JavaScript Expert",
              price: 330,
              discount: 2800
            },
            {
              img:
                "https://udemy-images.udemy.com/course/240x135/1002030_f3e0_5.jpg",
              name:
                "Web Development w/ Google’s Go (golang) Programming Language",
              description:
                "Learn Web Programming from a University Professor in Computer Science with over 15 years of teaching experience.",
              price: 330,
              discount: 2400
            }
          ]
        },
        {
          name: "Mobile Develeopment",
          description: "Shop and get your favourite items at amazing prices!",
          courses: [
            {
              img:
                "https://udemy-images.udemy.com/course/240x135/764164_de03_2.jpg",
              name: "The Complete Web Developer Course 2.0",
              description:
                "Learn Web Development by building 25 websites and mobile apps using HTML, CSS, Javascript, PHP, Python, MySQL & more!",
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
                "https://udemy-images.udemy.com/course/240x135/1212244_825c.jpg",
              name:
                "Android O & Java - Mobile App Development | Beginning to End",
              description:
                "The complete Android course with Android Studio & Java. Go from beginner to professional app developer.",
              price: 330,
              discount: 7800
            },
            {
              img:
                "https://udemy-images.udemy.com/course/240x135/529438_f64b_4.jpg",
              name: "Running a Mobile App Dev Business: The Complete Guide",
              description:
                "Learn how to start and grow a mobile app development business. Get up & running in less than 1 week.",
              price: 330,
              discount: 5600
            },
            {
              img:
                "https://udemy-images.udemy.com/course/240x135/1512578_b4eb_2.jpg",
              name: "Android App Development: Mobile App Development & Java",
              description:
                "Android App Development & Java Programming: Mobile App Development & Design, Build Android Apps, Android 5 & Lollipop",
              price: 330,
              discount: 7200
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
  methods: {
    getPercent(course) {
      return parseInt((course.discount - course.price) * 100 / course.discount);
    },
    numberWithCommas(number) {
      return number.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",");
    }
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

