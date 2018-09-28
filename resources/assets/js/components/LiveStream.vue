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
					<li class="active">Running a Mobile App Dev Business: The Complete Guide</li>
				</ul>
				<!-- END breadcrumb -->
				<div class="row">
					<div class="col-md-8">
						<div class="embed-responsive embed-responsive-16by9">
							<video ref="videoElement"></video>
						</div>
					</div>
					<div class="col-md-4">
						<div class="chatbox">
							<div class="message">
								<span class="username">
									DreaMTeryST :&nbsp;
								</span>
								<span class="badge badge-danger f-s-20">สวัสดีครับ</span>
								<span class="time">1:40</span>
							</div>
							<div class="message">
								<span class="username">
									DreaMTeryST :&nbsp;
								</span>
								<span class="badge badge-danger f-s-20">ท่านผู้ชม</span>
								<span class="time">1:41</span>
							</div>
							<div class="message">
								<span class="username">
									Moojy :&nbsp;
								</span>
								<span class="badge badge-info f-s-20">สงสัยค่ะ</span>
								<span class="time">2:30</span>
							</div>
							<div class="input">
								<input type="text" class="form-control" placeholder="พิมพ์ข้อความที่นี่" />
							</div>
						</div>
					</div>
				</div>
				<h4 class="m-t-15">Running a Mobile App Dev Business: The Complete Guide (Live)</h4>
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
	mounted() {
		const self = this;
		$(function () {
			if (flvjs.isSupported()) {
				var videoElement = self.$refs.videoElement;
				var player = flvjs.createPlayer({
					type: "flv",
					isLive: true,
					url: "http://178.128.50.9:8000/live/nodemedia2017privatekey.flv"
				});
				player.attachMediaElement(videoElement);
				player.load();
				player.play();
			}
		});
	}
};
</script>

<style>
</style>
