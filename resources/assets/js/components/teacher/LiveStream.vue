<template>
	<section>
		<!-- BEGIN #product -->
		<div id="product" class="section-container p-t-20">
			<!-- BEGIN container -->
			<div class="container">
				<!-- BEGIN breadcrumb -->
				<ul class="breadcrumb m-b-10 f-s-20">
					<li><a href="#">Home</a></li>
					<li><a href="#">Mobile Development</a></li>
					<li class="active">React Native สำหรับมือใหม่!!</li>
				</ul>
				<!-- END breadcrumb -->
				<div class="row">
					<div class="col-md-8">
						<img src="https://camo.githubusercontent.com/ecd56f66884ba473e09b7151764acf2054b23546/68747470733a2f2f692e696d6775722e636f6d2f5a443058426b472e706e67" class="img-responsive" />
					</div>
					<div class="col-md-4">
						<div class="m-b-20" v-if="user.type == 'teacher' || user.type == 'master'">
							<button type="button" class="btn btn-primary btn-block">
								<span class="f-s-20">เริ่มการสอน</span>
							</button>
						</div>
						<div class="chatbox">
							<div class="message">
								<span class="user-name-teacher">
									DreaMTeryST :&nbsp;
								</span>
								<span class="text">สวัสดีครับ</span>
								<span class="time">1:40</span>
							</div>
							<div class="message">
								<span class="user-name-teacher">
									DreaMTeryST :&nbsp;
								</span>
								<span class="text">ท่านผู้ชม</span>
								<span class="time">1:41</span>
							</div>
							<div class="message">
								<span class="user-name">
									Moojy :&nbsp;
								</span>
								<span class="text">สงสัยค่ะ</span>
								<span class="time">2:30</span>
							</div>
							<div class="input">
								<input type="text" class="form-control" placeholder="พิมพ์ข้อความที่นี่" />
							</div>
						</div>
					</div>
				</div>
				<h4 class="m-t-15">React Native สำหรับมือใหม่!! (Live)</h4>
				<div class="row row-space-10">
					<!-- BEGIN col-2 -->
					<div class="col-md-3 col-sm-4">
						<!-- BEGIN item -->
						<div class="item item-thumbnail">
							<router-link to="" class="item-image">
								<img src="http://img.timeinc.net/time/daily/2012/1211/poy_benbernanke.jpg" alt="" />
							</router-link>
							<div class="item-info">
								<h4 class="item-title">
									<router-link to="" class="f-s-20">Benbernanke</router-link>
								</h4>
							</div>
						</div>
						<!-- END item -->
					</div>
					<!-- END col-2 -->
					<div class="col-md-3 col-sm-4">
						<!-- BEGIN item -->
						<div class="item item-thumbnail">
							<router-link to="" class="item-image">
								<img src="data:image/jpeg;base64,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" alt="" />
							</router-link>
							<div class="item-info">
								<h4 class="item-title">
									<router-link to="" class="f-s-20">Jake</router-link>
								</h4>
							</div>
						</div>
						<!-- END item -->
					</div>
					<!-- END col-2 -->
					<div class="col-md-3 col-sm-4">
						<!-- BEGIN item -->
						<div class="item item-thumbnail">
							<router-link to="" class="item-image">
								<img src="http://img.timeinc.net/time/photoessays/2008/people_who_mattered/obama_main_1216.jpg" alt="" />
							</router-link>
							<div class="item-info">
								<h4 class="item-title">
									<router-link to="" class="f-s-20">Melany</router-link>
								</h4>
							</div>
						</div>
						<!-- END item -->
					</div>
					<!-- END col-2 -->
					<div class="col-md-3 col-sm-4">
						<!-- BEGIN item -->
						<div class="item item-thumbnail">
							<router-link to="" class="item-image">
								<img src="https://www.telegraph.co.uk/content/dam/news/2017/11/22/TELEMMGLPICT000147365976_trans_NvBQzQNjv4Bq3XmyF3YIL3K1caQxZsZv2Ssm-UOV8_Q90I8_c5Af0yY.jpeg?imwidth=450" alt="" />
							</router-link>
							<div class="item-info">
								<h4 class="item-title">
									<router-link to="" class="f-s-20">John</router-link>
								</h4>
							</div>
						</div>
						<!-- END item -->
					</div>
					<!-- END col-2 -->
				</div>
				<!-- END similar-product -->
				<hr/>
				<!-- BEGIN similar-product -->
				<h4 class="m-b-15 m-t-30">You Might Also Like</h4>
				<div class="row row-space-10">
					<!-- BEGIN col-2 -->
					<div class="col-md-2 col-sm-4" v-for="(like, i) in likes" :key="i">
						<!-- BEGIN item -->
						<div class="item item-thumbnail">
							<router-link to="/product-detail" class="item-image">
								<img :src="like.img" alt="" />
								<div class="discount">{{ getPercent(like) }}% OFF</div>
							</router-link>
							<div class="item-info">
								<h4 class="item-title">
									<router-link to="/product-detail">{{ like.name }}</router-link>
								</h4>
								<p class="item-desc">{{ like.description }}</p>
								<div class="item-price">฿ {{ numberWithCommas(like.price) }}</div>
								<div class="item-discount-price">฿ {{ numberWithCommas(like.discount) }}</div>
							</div>
						</div>
						<!-- END item -->
					</div>
					<!-- END col-2 -->
				</div>
				<!-- END similar-product -->
			</div>
		</div>
	</section>
</template>

<script>
import { mapState } from 'vuex';
export default {
	data: () => ({
		likes: [
			{
				img: "https://udemy-images.udemy.com/course/240x135/764164_de03_2.jpg",
				name: "The Complete Web Developer Course 2.0",
				description:
					"Learn Web Development by building 25 websites and mobile apps using HTML, CSS, Javascript, PHP, Python, MySQL & more!",
				price: 330,
				discount: 7800
			},
			{
				img: "https://udemy-images.udemy.com/course/240x135/959700_8bd2_9.jpg",
				name: "The Complete React Native and Redux Course",
				description:
					"iOS and Android App Development from scratch - build full React Native mobile apps ridiculously fast!",
				price: 330,
				discount: 3600
			},
			{
				img: "https://udemy-images.udemy.com/course/240x135/1212244_825c.jpg",
				name: "Android O & Java - Mobile App Development | Beginning to End",
				description:
					"The complete Android course with Android Studio & Java. Go from beginner to professional app developer.",
				price: 330,
				discount: 7800
			},
			{
				img: "https://udemy-images.udemy.com/course/240x135/529438_f64b_4.jpg",
				name: "Running a Mobile App Dev Business: The Complete Guide",
				description:
					"Learn how to start and grow a mobile app development business. Get up & running in less than 1 week.",
				price: 330,
				discount: 5600
			},
			{
				img: "https://udemy-images.udemy.com/course/240x135/1512578_b4eb_2.jpg",
				name: "Android App Development: Mobile App Development & Java",
				description:
					"Android App Development & Java Programming: Mobile App Development & Design, Build Android Apps, Android 5 & Lollipop",
				price: 330,
				discount: 7200
			},
			{
				img: "https://udemy-images.udemy.com/course/240x135/1017096_0e3f_3.jpg",
				name: "Mobile App Development for Beginners (Swift 3, iPhone iOS10)",
				description:
					"iPhone (iOS 10) app development. The complete development course. Use Swift 3 & Xcode 8 to design 10 iPhone apps.",
				price: 330,
				discount: 1800
			}
		]
	}),
	computed: {
		...mapState(['user'])
	},
	mounted() {

	}
};
</script>

<style>
</style>
