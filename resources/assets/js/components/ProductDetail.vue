<template>
    <section>
        <!-- BEGIN #product -->
        <div id="product" class="section-container p-t-20">
            <!-- BEGIN container -->
            <div class="container">
                <!-- BEGIN breadcrumb -->
                <ul class="breadcrumb m-b-10 f-s-12">
                    <li><a href="#">Home</a></li>
                    <li><a href="#">Mobile Development</a></li>
                    <li class="active">Running a Mobile App Dev Business: The Complete Guide</li>
                </ul>
                <!-- END breadcrumb -->
                
                <!-- BEGIN product -->
                <div class="product">
                    <!-- BEGIN product-detail -->
                    <div class="product-detail">
                        <!-- BEGIN product-image -->
                        <div class="product-image">
                                <iframe width="560" height="315" src="https://www.youtube.com/embed/1NHAQf0D-RI" frameborder="0" allow="autoplay; encrypted-media" allowfullscreen></iframe>                            <div class="row row-space-10">
                                <div class="col-sm-4">
                                    <router-link to="/product-detail" class="item-video">
                                        <img src="https://udemy-images.udemy.com/course/240x135/284076_749f_7.jpg" alt="" />
                                    </router-link>
                                </div>
                                <div class="col-sm-4">
                                    <router-link to="/product-detail" class="item-video">
                                        <img src="https://udemy-images.udemy.com/course/240x135/284076_749f_7.jpg" alt="" />
                                    </router-link>
                                </div>
                                <div class="col-sm-4">
                                    <router-link to="/product-detail" class="item-video">
                                        <img src="https://udemy-images.udemy.com/course/240x135/284076_749f_7.jpg" alt="" />
                                    </router-link>
                                </div>
                            </div>
                        </div>
                        <!-- END product-image -->
                        <!-- BEGIN product-info -->
                        <div class="product-info">
                            <!-- BEGIN product-info-header -->
                            <div class="product-info-header">
                                <h1 class="product-title"><span class="label label-success">41% OFF</span> Running a Mobile App Dev Business: The Complete Guide</h1>
                                <ul class="product-category">
                                    <li><a href="#">Mobile</a></li>
                                    <li>/</li>
                                    <li><a href="#">Business</a></li>
                                    <li>/</li>
                                    <li><a href="#">Android</a></li>
                                    <li>/</li>
                                    <li><a href="#">IOS</a></li>
                                </ul>
                            </div>
                            <!-- END product-info-header -->
                            <!-- BEGIN product-warranty -->
                            <div class="product-warranty">
                                <h3>What Will I Learn?</h3>
                            </div>
                            <!-- END product-warranty -->
                            <!-- BEGIN product-info-list -->
                            <ul class="product-info-list">
                                <li><i class="fa fa-circle"></i> Choose the most effective platform strategy for your business</li>
                                <li><i class="fa fa-circle"></i> Predict the timeline for starting your business and effectively allocate your time</li>
                                <li><i class="fa fa-circle"></i> Choose whether or not to offer generalized or specialized mobile services</li>
                                <li><i class="fa fa-circle"></i> Recognize the core components of successful mobile development firms</li>
                                <li><i class="fa fa-circle"></i> Select a name that's attractive and conveys your core messaging</li>
                                <li><i class="fa fa-circle"></i> Use advanced search techniques to find specialty contractors</li>
                                <li><i class="fa fa-circle"></i> Use uncommon techniques to grow your portfolio faster</li>
                            </ul>
                            <!-- END product-info-list -->
                            <!-- BEGIN product-purchase-container -->
                            <div class="product-purchase-container">
                                <div class="product-discount">
                                    <span class="discount">$869.00</span>
                                </div>
                                <div class="product-price">
                                    <div class="price">$749.00</div>
                                </div>
                                <button class="btn btn-inverse btn-lg" type="submit">ADD TO CART</button>
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
                            <li class="active"><a href="#curriculum" data-toggle="tab">Curriculum For This Course</a></li>
                        </ul>
                        <!-- END #product-tab -->
                        <!-- BEGIN #product-tab-content -->
                        <div id="product-tab-content" class="tab-content">
                            <!-- BEGIN #curriculum -->
                            <div class="tab-pane fade active in" id="curriculum">
                                <b-card no-body class="mb-1">
                                    <b-card-header header-tag="header" class="p-1" role="tab">
                                        <b-btn block href="#" v-b-toggle.accordion1 variant="info">
                                            <i class="fa fa-plus"></i> Introduction
                                        </b-btn>
                                    </b-card-header>
                                    <b-collapse id="accordion1" visible accordion="my-accordion" role="tabpanel">
                                        <b-card-body>
                                            <ul class="curriculum">
                                                <li>
                                                    <router-link to="#">
                                                        <i class="fa fa-play-circle"></i> Course Overview
                                                    </router-link>
                                                </li>
                                                <li>
                                                    <router-link to="#">
                                                        <i class="fa fa-play-circle"></i> 7 reasons to start a mobile app development business
                                                    </router-link>
                                                </li>
                                                <li>
                                                    <router-link to="#">
                                                        <i class="fa fa-play-circle"></i> The Sprintkick story
                                                    </router-link>
                                                </li>
                                            </ul>
                                        </b-card-body>
                                    </b-collapse>
                                    </b-card>
                                    <b-card no-body class="mb-1">
                                    <b-card-header header-tag="header" class="p-1" role="tab">
                                        <b-btn block href="#" v-b-toggle.accordion2 variant="info">
                                            <i class="fa fa-plus"></i> The Essentials
                                        </b-btn>
                                    </b-card-header>
                                    <b-collapse id="accordion2" accordion="my-accordion" role="tabpanel">
                                        <b-card-body>
                                            <ul class="curriculum">
                                                <li>
                                                    <router-link to="#">
                                                        <i class="fa fa-play-circle"></i> The startup timeline
                                                    </router-link>
                                                </li>
                                                <li>
                                                    <router-link to="#">
                                                        <i class="fa fa-play-circle"></i> How does this work as a programmer / non programmer?
                                                    </router-link>
                                                </li>
                                                <li>
                                                    <router-link to="#">
                                                        <i class="fa fa-play-circle"></i> iOS versus Android
                                                    </router-link>
                                                </li>
                                                <li>
                                                    <router-link to="#">
                                                        <i class="fa fa-play-circle"></i> Native versus hybrid
                                                    </router-link>
                                                </li>
                                                <li>
                                                    <router-link to="#">
                                                        <i class="fa fa-play-circle"></i> Build yourself or contract?
                                                    </router-link>
                                                </li>
                                                <li>
                                                    <router-link to="#">
                                                        <i class="fa fa-play-circle"></i> In-house hiring or out of house?
                                                    </router-link>
                                                </li>
                                                <li>
                                                    <router-link to="#">
                                                        <i class="fa fa-play-circle"></i> In country or out of country?
                                                    </router-link>
                                                </li>
                                            </ul>
                                        </b-card-body>
                                    </b-collapse>
                                    </b-card>
                                    <b-card no-body class="mb-1">
                                    <b-card-header header-tag="header" class="p-1" role="tab">
                                        <b-btn block href="#" v-b-toggle.accordion3 variant="info">
                                            <i class="fa fa-plus"></i> Setting up your presence
                                        </b-btn>
                                    </b-card-header>
                                    <b-collapse id="accordion3" accordion="my-accordion" role="tabpanel">
                                        <b-card-body>
                                            <ul class="curriculum">
                                                <li>
                                                    <router-link to="#">
                                                        <i class="fa fa-play-circle"></i> Focus on 80/20 solutions for your online presence
                                                    </router-link>
                                                </li>
                                                <li>
                                                    <router-link to="#">
                                                        <i class="fa fa-play-circle"></i> Looking at other studios
                                                    </router-link>
                                                </li>
                                                <li>
                                                    <router-link to="#">
                                                        <i class="fa fa-play-circle"></i> Going further in-depth looking at studios
                                                    </router-link>
                                                </li>
                                                <li>
                                                    <router-link to="#">
                                                        <i class="fa fa-play-circle"></i> Picking and configuring a template on Templatemonster
                                                    </router-link>
                                                </li>
                                                <li>
                                                    <router-link to="#">
                                                        <i class="fa fa-play-circle"></i> Picking and configuring a template on ThemeForest
                                                    </router-link>
                                                </li>
                                                <li>
                                                    <router-link to="#">
                                                        <i class="fa fa-play-circle"></i> Selecting a name
                                                    </router-link>
                                                </li>
                                                <li>
                                                    <router-link to="#">
                                                        <i class="fa fa-play-circle"></i> Advanced: Upgrade your presence with custom design
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
                            <li class="active"><a href="#product-desc" data-toggle="tab">Product Description</a></li>
                        </ul>
                        <!-- END #product-tab -->
                        <!-- BEGIN #product-tab-content -->
                        <div id="product-tab-content" class="tab-content">
                            <!-- BEGIN #product-desc -->
                            <div class="tab-pane fade active in" id="product-desc">
                                <h3>Requirement</h3>
                                <ul>
                                    <li>Requirements
                                    <li>No pre-requisites necessary.</li>
                                    <li>Programming experience is helpful but not necessary.</li>
                                </ul>
                                <h3>Description</h3>
                                <p>
                                    The mobile app development industry is growing at a blazing 43% per year and shows no signs of slowing down. This represents a huge opportunity for you - bigger than it's ever been before. Whether you want to code or not, you can capitalize on the over 16 billion dollars of money spent per year on mobile app development services. Part-time or full-time, you can build an awesome portfolio and an even better income taking on mobile app development projects. 
                                </p>
                                <p>
                                    Over the last four years I've personally overseen the launch of over 100 apps from concept to deployment. I've grown my business from one small client to over 100. Today, we make apps for big name brands such as Walmart, GNC, Dick's Sporting Goods, and other Fortune 500 companies.
                                </p>
                                <p>
                                    I created this course to teach you how you can hit the ground running by starting a mobile app development business - no coding 
                                </p>
                                <p>
                                    necessary. I see a lot of people floundering to start or grow their mobile businesses because they don't have the mentorship or the guidance to do it right. This course is my answer for all of you who have reached out for help. I've piled everything I know and everything that has made my business successful into this course. I'm going to show you how to jumpstart your business, grow it quickly, and manage your business like a professional - all from the comfort of your laptop.
                                </p>
                                <h3>Who is the target audience?</h3>
                                <ul>
                                    <li>Mobile app developers who want to learn how to expand their skills into a business.
                                    <li>Non-technical entrepreneurs who want to start a business building mobile apps.</li>
                                    <li>Established freelancers who want to add development services to their offerings.</li>
                                    <li>Marketing, strategy, and SEO consultants who want to expand their business and offer more to their clients.</li>
                                </ul>
                            </div>
                            <!-- END #product-desc -->
                        </div>
                        <!-- END #product-tab-content -->
                    </div>
                    <!-- END product-tab -->
                </div>
                <!-- END product -->
                
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
            <!-- END container -->
        </div>
        <!-- END #product -->
    </section>
</template>

<script>
export default {
    data() {
        return {
            likes: [{
                'img': 'https://udemy-images.udemy.com/course/240x135/764164_de03_2.jpg',
                'name': 'The Complete Web Developer Course 2.0',
                'description': 'Learn Web Development by building 25 websites and mobile apps using HTML, CSS, Javascript, PHP, Python, MySQL & more!',
                'price': 330,
                'discount': 7800
            },{
                'img': 'https://udemy-images.udemy.com/course/240x135/959700_8bd2_9.jpg',
                'name': 'The Complete React Native and Redux Course',
                'description': 'iOS and Android App Development from scratch - build full React Native mobile apps ridiculously fast!',
                'price': 330,
                'discount': 3600
            },{
                'img': 'https://udemy-images.udemy.com/course/240x135/1212244_825c.jpg',
                'name': 'Android O & Java - Mobile App Development | Beginning to End',
                'description': 'The complete Android course with Android Studio & Java. Go from beginner to professional app developer.',
                'price': 330,
                'discount': 7800
            },{
                'img': 'https://udemy-images.udemy.com/course/240x135/529438_f64b_4.jpg',
                'name': 'Running a Mobile App Dev Business: The Complete Guide',
                'description': 'Learn how to start and grow a mobile app development business. Get up & running in less than 1 week.',
                'price': 330,
                'discount': 5600
            },{
                'img': 'https://udemy-images.udemy.com/course/240x135/1512578_b4eb_2.jpg',
                'name': 'Android App Development: Mobile App Development & Java',
                'description': 'Android App Development & Java Programming: Mobile App Development & Design, Build Android Apps, Android 5 & Lollipop',
                'price': 330,
                'discount': 7200
            },{
                'img': 'https://udemy-images.udemy.com/course/240x135/1017096_0e3f_3.jpg',
                'name': 'Mobile App Development for Beginners (Swift 3, iPhone iOS10)',
                'description': 'iPhone (iOS 10) app development. The complete development course. Use Swift 3 & Xcode 8 to design 10 iPhone apps.',
                'price': 330,
                'discount': 1800
            }]
        }
    },
    methods: {
        getPercent(course) {
            return parseInt((course.discount - course.price) * 100 / course.discount);
        },
        numberWithCommas(number) {
            return number.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",");
        }
    }
}
</script>

<style>
.curriculum {
    margin-top: 10px;
}
.curriculum > li {
    list-style-type: none;
    margin-top: 5px;
    margin-bottom: 5px;
    padding-bottom: 5px;
    border-bottom: 1px dashed #06f;
}
.item-video {
    max-width: 100%;
}
.item-video:after, .item-video:before {
    position: absolute;
    opacity: 0;
    transition: all 0.5s;
    -webkit-transition: all 0.5s;
}
.item-video:after {
    content: '\A';
    width: 100%; height:100%;
    top: 0; left:0;
    background:rgba(0,0,0,0.6);
}
.item-video:before {
    content: "\f144";
    font-family: FontAwesome;
    font-style: normal;
    font-weight: normal;
    text-decoration: inherit;
    font-size: 40px;
    color: white;
    text-decoration: none;
    z-index: 1;
    position: absolute;
    left: 50%;
    top: 50%;
    -webkit-transform: translate(-50%, -50%);
    transform: translate(-50%, -50%);
}
.item-video:hover:after, .item-video:hover:before {
    opacity: 1;
}
.product-image {
    padding: 10px;
}
</style>
