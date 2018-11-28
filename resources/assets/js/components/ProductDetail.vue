<template>
    <section>
        <!-- BEGIN #product -->
        <div id="product" class="section-container p-t-20">
            <!-- BEGIN container -->
            <div class="container">
                <!-- BEGIN breadcrumb -->
                <ul class="breadcrumb m-b-10 f-s-20">
                    <li>
                        <a href="#">Home</a>
                    </li>
                    <li>
                        <a href="#" v-if="course.category">{{ course.category.category_name }}</a>
                    </li>
                    <li class="active">{{ course.course_name }}</li>
                </ul>
                <!-- END breadcrumb -->

                <!-- BEGIN product -->
                <div class="product">
                    <!-- BEGIN product-detail -->
                    <div class="product-detail">
                        <!-- BEGIN product-image -->
                        <div class="product-image">
                            <div class="embed-responsive embed-responsive-16by9">
                                <!-- <video ref="videoElement"></video> -->
                                <iframe width="560" height="315" :src="course.course_video" frameborder="0" allow="autoplay; encrypted-media" allowfullscreen></iframe>
                            </div>
                        </div>
                        <!-- END product-image -->
                        <!-- BEGIN product-info -->
                        <div class="product-info">
                            <!-- BEGIN product-info-header -->
                            <div class="product-info-header">
                                <h1 class="product-title">
                                    <span class="label label-success">{{getPercent(course)}}% OFF</span> {{ course.course_name}}</h1>
                                <ul class="product-category">
                                    <li>
                                        <a href="#" v-if="course.category">{{ course.category.category_name }}</a>
                                    </li>
                                </ul>
                            </div>
                            <!-- END product-info-header -->
                            <!-- BEGIN product-warranty -->
                            <div class="product-warranty">
                                <h4>What will you learn?</h4>
                            </div>
                            <!-- END product-warranty -->
                            <!-- BEGIN product-info-list -->
                            <ul class="product-info-list">
                                <li v-for="(result, i) in course.result" :key="i">
                                    <i class="fa fa-circle"></i> {{ result }}
                                </li>
                            </ul>
                            <!-- END product-info-list -->
                            <!-- BEGIN product-purchase-container -->
                            <div class="product-purchase-container">
                                <div class="product-discount">
                                    <span class="discount" v-if="course.course_price">฿{{ numberWithCommas(course.course_price) }}</span>
                                </div>
                                <div class="product-price">
                                    <div class="price" v-if="course.course_discounted">฿{{ numberWithCommas(course.course_discounted) }}</div>
                                </div>
                                <button class="btn btn-inverse btn-lg" type="button">PURCHASE</button>
                            </div>
                            <!-- END product-purchase-container -->
                        </div>
                        <!-- END product-info -->
                    </div>
                    <!-- END product-detail -->
                    <!-- BEGIN product-tab -->
                    <div class="product-tab">
                        <!-- BEGIN #product-tab -->
                        <ul id="product-tab" class="nav nav-tabs">
                            <li class="active">
                                <a href="#curriculum" data-toggle="tab">Curriculum For This Course</a>
                            </li>
                        </ul>
                        <!-- END #product-tab -->
                        <!-- BEGIN #product-tab-content -->
                        <div id="product-tab-content" class="tab-content">
                            <!-- BEGIN #curriculum -->
                            <div class="tab-pane fade active in" id="curriculum" v-for="(unit, i) in course.units" :key="i">
                                <b-card no-body class="mb-1">
                                    <b-card-header header-tag="header" class="p-1" role="tab">
                                        <b-btn block href="#" v-b-toggle="'accordion-' + i" variant="info" class="btn-left">
                                            <i class="fa fa-plus"></i> {{ unit.unit_name }}
                                        </b-btn>
                                    </b-card-header>
                                    <b-collapse :id="'accordion-' + i" accordion="my-accordion" role="tabpanel">
                                        <b-card-body>
                                            <ul class="curriculum" v-for="(lecture, j) in unit.lectures" :key="j">
                                                <li>
                                                    <router-link to="#">
                                                        <i class="fa fa-play-circle"></i> {{ lecture.lecture_name }}
                                                    </router-link>
                                                </li>
                                            </ul>
                                        </b-card-body>
                                    </b-collapse>
                                </b-card>
                            </div>
                            <!-- END #curriculum -->
                        </div>
                        <!-- END #product-tab-content -->
                    </div>
                    <!-- END product-tab -->
                    <!-- BEGIN product-tab -->
                    <div class="product-tab">
                        <!-- BEGIN #product-tab -->
                        <ul id="product-tab" class="nav nav-tabs">
                            <li class="active">
                                <a href="#product-desc" data-toggle="tab">Product Description</a>
                            </li>
                        </ul>
                        <!-- END #product-tab -->
                        <!-- BEGIN #product-tab-content -->
                        <div id="product-tab-content" class="tab-content">
                            <!-- BEGIN #product-desc -->
                            <div class="tab-pane fade active in" id="product-desc">
                                <h3 v-if="course.requirements">Requirement</h3>
                                <ul v-if="course.requirements">
                                    <li v-for="(item, i) in course.requirements" :key="i">{{ item }}</li>
                                </ul>
                                <h3>Description</h3>
                                <p v-html="course.course_description"></p>
                            </div>
                            <!-- END #product-desc -->
                        </div>
                        <!-- END #product-tab-content -->
                    </div>
                    <!-- END product-tab -->
                </div>
                <!-- END product -->

                <!-- BEGIN similar-product -->
                <h4 class="m-b-15 m-t-30">คอร์สที่คุณอาจจะชอบ</h4>
                <div class="row row-space-10">
                    <!-- BEGIN col-2 -->
                    <div class="col-md-2 col-sm-4" v-for="(like, i) in likes" :key="i">
                        <!-- BEGIN item -->
                        <div class="item item-thumbnail">
                            <router-link :to="`/product-detail/${like.id}`" class="item-image">
                                <img :src="like.course_picture" alt="" />
                                <div class="discount">{{ getPercent(like) }}% OFF</div>
                            </router-link>
                            <div class="item-info">
                                <h4 class="item-title">
                                    <router-link to="/product-detail">{{ like.course_name }}</router-link>
                                </h4>
                                <p class="item-desc">{{ like.course_description }}</p>
                                <div class="item-price" v-if="like.course_discounted">฿ {{ numberWithCommas(like.course_discounted) }}</div>
                                <div class="item-discount-price" v-if="like.course_price">฿ {{ numberWithCommas(like.course_price) }}</div>
                            </div>
                        </div>
                        <!-- END item -->
                    </div>
                    <!-- END col-2 -->
                </div>
                <!-- END similar-product -->
            </div>
            <!-- END container -->
        </div>
        <!-- END #product -->
    </section>
</template>

<script>
export default {
    data() {
        return {
            course: '',
            likes: '',
            links: [
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
                    img: "https://udemy-images.udemy.com/course/240x135/1212244_825c.jpg",
                    name: "Android O & Java - Mobile App Development | Beginning to End",
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
                    name: "Mobile App Development for Beginners (Swift 3, iPhone iOS10)",
                    description:
                        "iPhone (iOS 10) app development. The complete development course. Use Swift 3 & Xcode 8 to design 10 iPhone apps.",
                    price: 330,
                    discount: 1800
                }
            ],
        };
    },
    mounted() {
        axios.get(`/api/course/${this.$route.params.id}`).then(({data}) => {
            this.course = data
        }).catch(error => {
            console.log(error)
			if(error.response) console.log(error.response)
        })
        axios.get(`/api/course/like/${this.$route.params.id}`).then(({data}) => {
            this.likes = data
        }).catch(error => {
            console.log(error)
			if(error.response) console.log(error.response)
        })
    }
};
</script>

<style>
</style>
