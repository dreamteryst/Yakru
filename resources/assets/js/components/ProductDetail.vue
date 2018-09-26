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
                        <a href="#">Mobile Development</a>
                    </li>
                    <li class="active">React Native สำหรับมือใหม่!!</li>
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
                                <iframe width="560" height="315" src="https://www.youtube.com/embed/mkualZPRZCs" frameborder="0" allow="autoplay; encrypted-media" allowfullscreen></iframe>
                            </div>
                        </div>
                        <!-- END product-image -->
                        <!-- BEGIN product-info -->
                        <div class="product-info">
                            <!-- BEGIN product-info-header -->
                            <div class="product-info-header">
                                <h1 class="product-title">
                                    <span class="label label-success">41% OFF</span> React Native สำหรับมือใหม่!!</h1>
                                <ul class="product-category">
                                    <li>
                                        <a href="#">Mobile Development</a>
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
                                <li>
                                    <i class="fa fa-circle"></i> Setup and Introduction</li>
                                <li>
                                    <i class="fa fa-circle"></i> Mastering User Interface</li>
                                <li>
                                    <i class="fa fa-circle"></i> Platform Specific</li>
                                <li>
                                    <i class="fa fa-circle"></i> Using Dynamic Content and Network (JSON Http Feed)</li>
                                <li>
                                    <i class="fa fa-circle"></i> Access Native Device Feature</li>
                                <li>
                                    <i class="fa fa-circle"></i> User Input, Form and Data Management</li>
                                <li>
                                    <i class="fa fa-circle"></i> Using Google Map</li>
                                <li>
                                    <i class="fa fa-circle"></i> การเตรียม Resources, เทคนิคการ Build App และอัปโหลด App ไปที่ Store</li>
                            </ul>
                            <!-- END product-info-list -->
                            <!-- BEGIN product-purchase-container -->
                            <div class="product-purchase-container">
                                <div class="product-discount">
                                    <span class="discount">฿869.00</span>
                                </div>
                                <div class="product-price">
                                    <div class="price">฿749.00</div>
                                </div>
                                <button class="btn btn-inverse btn-lg" type="button" @click="play">ADD TO CART</button>
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
                            <div class="tab-pane fade active in" id="curriculum" v-for="(course, i) in courses" :key="i">
                                <b-card no-body class="mb-1">
                                    <b-card-header header-tag="header" class="p-1" role="tab">
                                        <b-btn block href="#" v-b-toggle="'accordion-' + i" variant="info" class="btn-left">
                                            <i class="fa fa-plus"></i> {{ course.title }}
                                        </b-btn>
                                    </b-card-header>
                                    <b-collapse :id="'accordion-' + i" accordion="my-accordion" role="tabpanel">
                                        <b-card-body>
                                            <ul class="curriculum" v-for="(sub, j) in course.sub" :key="j">
                                                <li>
                                                    <router-link to="#">
                                                        <i class="fa fa-play-circle"></i> {{ sub.name }}
                                                    </router-link>
                                                </li>
                                            </ul>
                                        </b-card-body>
                                    </b-collapse>
                                </b-card>
                                <!-- <b-card no-body class="mb-1">
                                    <b-card-header header-tag="header" class="p-1" role="tab">
                                        <b-btn block href="#" v-b-toggle.accordion1 variant="info" class="btn-left">
                                            <i class="fa fa-plus"></i> Setup and Introduction
                                        </b-btn>
                                    </b-card-header>
                                    <b-collapse id="accordion1" visible accordion="my-accordion" role="tabpanel">
                                        <b-card-body>
                                            <ul class="curriculum">
                                                <li>
                                                    <router-link to="#">
                                                        <i class="fa fa-play-circle"></i> Course Introduction
                                                    </router-link>
                                                </li>
                                                <li>
                                                    <router-link to="#">
                                                        <i class="fa fa-play-circle"></i> NodeJS Install
                                                    </router-link>
                                                </li>
                                                <li>
                                                    <router-link to="#">
                                                        <i class="fa fa-play-circle"></i> React-Native & Watchman
                                                    </router-link>
                                                </li>
                                                 <li>
                                                    <router-link to="#">
                                                        <i class="fa fa-play-circle"></i> Visual Studio Install and React-Native Extension Pack
                                                    </router-link>
                                                </li>
                                                 <li>
                                                    <router-link to="#">
                                                        <i class="fa fa-play-circle"></i> React-Native CLI
                                                    </router-link>
                                                </li>
                                                 <li>
                                                    <router-link to="#">
                                                        <i class="fa fa-play-circle"></i> How to use the React-Native Documentation
                                                    </router-link>
                                                </li>
                                                 <li>
                                                    <router-link to="#">
                                                        <i class="fa fa-play-circle"></i> Basic ReactJS Langulage (ES5/6 and JSX)
                                                    </router-link>
                                                </li>
                                                 <li>
                                                    <router-link to="#">
                                                        <i class="fa fa-play-circle"></i> React Component and Basic UI
                                                    </router-link>
                                                </li>
                                                 <li>
                                                    <router-link to="#">
                                                        <i class="fa fa-play-circle"></i> Styling and Theming
                                                    </router-link>
                                                </li>
                                                <li>
                                                    <router-link to="#">
                                                        <i class="fa fa-play-circle"></i> Debugging / JS-Debugging / Auto-Reload
                                                    </router-link>
                                                </li>
                                            </ul>
                                        </b-card-body>
                                    </b-collapse>
                                </b-card> -->
                                <!-- <b-card no-body class="mb-1">
                                    <b-card-header header-tag="header" class="p-1" role="tab">
                                        <b-btn block href="#" v-b-toggle.accordion2 variant="info" class="btn-left">
                                            <i class="fa fa-plus"></i> The Essentials
                                        </b-btn>
                                    </b-card-header>
                                    <b-collapse id="accordion2" accordion="my-accordion" role="tabpanel">
                                        <b-card-body>
                                            <ul class="curriculum">
                                                <li>
                                                    <router-link to="#">
                                                        <i class="fa fa-play-circle"></i> 
                                                    </router-link>
                                                </li>
                                            </ul>
                                        </b-card-body>
                                    </b-collapse>
                                </b-card> -->
                                <!-- <b-card no-body class="mb-1">
                                    <b-card-header header-tag="header" class="p-1" role="tab">
                                        <b-btn block href="#" v-b-toggle.accordion2 variant="info" class="btn-left">
                                            <i class="fa fa-plus"></i> Mastering User Interface
                                        </b-btn>
                                    </b-card-header>
                                    <b-collapse id="accordion2" accordion="my-accordion" role="tabpanel">
                                        <b-card-body>
                                            <ul class="curriculum">
                                                <li>
                                                    <router-link to="#">
                                                        <i class="fa fa-play-circle"></i> 
                                                    </router-link>
                                                </li>
                                                <li>
                                                    <router-link to="#">
                                                        <i class="fa fa-play-circle"></i> 
                                                    </router-link>
                                                </li>
                                                <li>
                                                    <router-link to="#">
                                                        <i class="fa fa-play-circle"></i> 
                                                    </router-link>
                                                </li>
                                                <li>
                                                    <router-link to="#">
                                                        <i class="fa fa-play-circle"></i> 
                                                    </router-link>
                                                </li>
                                                <li>
                                                    <router-link to="#">
                                                        <i class="fa fa-play-circle"></i> 
                                                    </router-link>
                                                </li>
                                                <li>
                                                    <router-link to="#">
                                                        <i class="fa fa-play-circle"></i> 
                                                    </router-link>
                                                </li>
                                                <li>
                                                    <router-link to="#">
                                                        <i class="fa fa-play-circle"></i> 
                                                    </router-link>
                                                </li>
                                                <li>
                                                    <router-link to="#">
                                                        <i class="fa fa-play-circle"></i> 
                                                    </router-link>
                                                </li>
                                                <li>
                                                    <router-link to="#">
                                                        <i class="fa fa-play-circle"></i> 
                                                    </router-link>
                                                </li>
                                                <li>
                                                    <router-link to="#">
                                                        <i class="fa fa-play-circle"></i> 
                                                    </router-link>
                                                </li>
                                                <li>
                                                    <router-link to="#">
                                                        <i class="fa fa-play-circle"></i> 
                                                    </router-link>
                                                </li>
                                                <li>
                                                    <router-link to="#">
                                                        <i class="fa fa-play-circle"></i> 
                                                    </router-link>
                                                </li>
                                                <li>
                                                    <router-link to="#">
                                                        <i class="fa fa-play-circle"></i> 
                                                    </router-link>
                                                </li>
                                                <li>
                                                    <router-link to="#">
                                                        <i class="fa fa-play-circle"></i> 
                                                    </router-link>
                                                </li>
                                                <li>
                                                    <router-link to="#">
                                                        <i class="fa fa-play-circle"></i> 
                                                    </router-link>
                                                </li>
                                            </ul>
                                        </b-card-body>
                                    </b-collapse>
                                </b-card> -->
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
                                <h3>Requirement</h3>
                                <ul>
                                        <li>Javascript</li>
                                        <li>HTML</li>
                                        <li>CSS</li>
                                </ul>
                                <h3>Description</h3>
                                <p>
                                    React-Native คือ Cross-Platform Framework ที่ใช้ในการพัฒนา Native Mobile Application อย่าง Android และ iOS ที่พัฒนาโดยบริษัท Facebook Inc. React Native มีหลักการคล้ายกับ Xamarin คือมันสามารถ Reuse Code ได้มากกว่า 70% ในการทำแอพที่รันได้ทั้งบน Android และ iOS โดยใช้ภาษาหลักภาษาเดียว คือภาษา ReactJS (ES6 / JSX) ซึ่งใกล้เคียงกับ Javascript / Typescript / XML ในการพัฒนาแอพ ซึ่งเมื่อทำเสร็จ แอพจะทำงานไวใกล้เคียงกับการเขียนด้วย ภาษา Native อย่าง Java และ Swift/Objective-C
อีกหนึ่งจุดเด่นของ React Native คือการประยุกต์ใช้แนวคิดแบบ Reactive Programming ที่ทำให้การพัฒนารองรับการทำงานแบบ Asynchronous และมี State ที่ซับซ้อนได้
นอกจากนี้ในหลักสูตรจะมีการสอน Redux (State Container) ในการจัดการ State เพื่อให้การพัฒนารองรับระบบที่มีความซับซ้อนและดูเป็นมืออาชีพ รวมถึงการเขียนโค้ดที่ทำงานร่วมกับ Native API ที่เป็น Java หรือ Objective-C และแชร์ประสบการณ์การในพัฒนาแอพด้วย React-Native จริงๆ
                                </p>
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
                    <div class="col-md-2 col-sm-4" v-for="(like, i) in links" :key="i">
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
      courses: [
        {
            title: "Setup and Introduction",
            sub: [
                {
                    name: "Course Introduction"
                },
                {
                    name: "NodeJS Install"
                },
                {
                    name: "React-Native & Watchman"
                },
                {
                    name: "Visual Studio Install and React-Native Extension Pack"
                },
                {
                    name: "React-Native CLI"
                },
                {
                    name: "How to use the React-Native Documentation"
                },
                {
                    name: "Basic ReactJS Langulage (ES5/6 and JSX)"
                },
                {
                    name: "React Component and Basic UI"
                },
                {
                    name: "Styling and Theming"
                },
                {
                    name: "Debugging / JS-Debugging / Auto-Reload"
                }
            ]
        },
        {
            title: "Mastering User Interface",
            sub: [
                {
                    name: "React-Native Project Structure"
                },
                {
                    name: "Core User Interface Input / Output"
                },
                {
                    name: "Data Binding (Props and State)"
                },
                {
                    name: "Event Listener"
                },
                {
                    name: "Mutiple Screens"
                },
                {
                    name: "Redux, React-Redux"
                },
                {
                    name: "Redux Middleware Redux-Thunk"
                },
                {
                    name: "Reducer, Action, Dispatch"
                },
                {
                    name: "How Navigation works in an React-Native"
                },
                {
                    name: "Creating a Page and how to Navigate to it"
                },
                {
                    name: "Passing Data between Pages"
                },
                {
                    name: "Popping Pages - Callback Data"
                },
                {
                    name: "Using Redux for Page Navigation"
                },
                {
                    name: "Configuring Page Transitions"
                },
                {
                    name: "The Page Lifecycle in Action"
                }
            ]
        },
        {
            title: "Platform Specific Code",
            sub: [
                {
                    name: "Detecting OS (Android or iOS)"
                },
                {
                    name: "Detecting Android Version"
                },
                {
                    name: "Detecting iOS Version"
                },
                {
                    name: "Style and Size in Specific Platform"
                },
                {
                    name: "Platform-specific extensions"
                },
                {
                    name: "Access Platform Specific Code"
                }
            ]
        },
        {
            title: "Using Dynamic Content and Network (JSON Http Feed)",
            sub: [
                {
                    name: "Standard Network API - Fetch"
                },
                {
                    name: "3rd Party Network API - Axios"
                },
                {
                    name: "HTTP Fetching RESTful (JSON)"
                },
                {
                    name: "Fixing iOS HTTP (unsecured) Issue"
                },
                {
                    name: "Fetching data from MySql"
                },
                {
                    name: "ScrolllView"
                },
                {
                    name: "Setup FlatList"
                },
                {
                    name: "Styling ListView"
                },
                {
                    name: "Tap Event Listener"
                },{
                    name: "Add Loading Component"
                },
                {
                    name: "Add Pull to Refresh support to our app"
                },
                {
                    name: "การจัดการกับปัญหาเรื่อง Cross-Origin-Resource-Sharing (Cors)"
                }
            ]
        },
        {
            title: "Access Native Device Feature",
            sub: [
                {
                    name: "Runtime Permission"
                },
                {
                    name: "Youtube Video Player"
                },
                {
                    name: "Camera"
                },
                {
                    name: "arcode and QR Code Scanner"
                },
                {
                    name: "InAppBrowser"
                },
                {
                    name: "SQLite"
                },
                {
                    name: "Toasts"
                },
                {
                    name: "Call Number"
                },
                {
                    name: "File"
                },{
                    name: "File Path"
                },
                {
                    name: "File Transfer"
                }
            ]
        },
        {
            title: "User Input, Forms and Data Management",
            sub: [
                {
                    name: "How to use Local Storage"
                },
                {
                    name: "Learn 3rd-party Custom UI - 'UI Element'"
                },
                {
                    name: "Handle User Input"
                },
                {
                    name: "Registering Controls"
                },
                {
                    name: "Submitting the Form"
                },
                {
                    name: "Validating the Form"
                },
                {
                    name: "Handling Data with a Model for our Ingredients"
                },
                {
                    name: "Managing Data with a Service"
                },
                {
                    name: "insert, update, and delete data"
                },
                {
                    name: "Alerts"
                }
            ]
        },
        {
            title: "Using Google Map",
            sub: [
                {
                    name: "Using 3rd-party Library"
                },
                {
                    name: "Adding Google Maps to the App"
                },
                {
                    name: "Configuring our Maps"
                },
                {
                    name: "Allowing the User to Place a Marker on the Map"
                },
                {
                    name: "Displaying the Chosen Location"
                },
                {
                    name: "Geolocation to Locate the User"
                }
            ]
        },
        {
            title: "การเตรียม Resources, เทคนิคการ Build App และอัพโหลด App ไปที่ Store",
            sub: [
                {
                    name: "Custom Icons and Splashscreen"
                },
                {
                    name: "Configuration"
                },
                {
                    name: "Generate Distribution Files"
                },
                {
                    name: "Build Preparations and Building for Production"
                },
                {
                    name: "Publish to Google Play Store"
                },
                {
                    name: "Publish to Apple AppStore"
                }
            ]
        }
    ],
      player: null
    };
  },
  mounted() {
    const self = this;
    $(function() {
      if (flvjs.isSupported()) {
        var videoElement = self.$refs.videoElement;
        self.player = flvjs.createPlayer({
          type: "flv",
          //   url: "http://178.128.50.9:8000/live/nodemedia2017privatekey.flv"
          url: "/assets/flv/converted.flv"
        });
        self.player.attachMediaElement(videoElement);
        self.player.load();
      }
    });
  },
  methods: {
    getPercent(course) {
      return parseInt((course.discount - course.price) * 100 / course.discount);
    },
    numberWithCommas(number) {
      return number.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",");
    },
    play() {
      this.player.play();
    }
  }
};
</script>

<style>
.btn-left {
  text-align: left;
}
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
.item-video > img {
  min-width: 100%;
}
.item-video {
  max-width: 100%;
}
.item-video:after,
.item-video:before {
  position: absolute;
  opacity: 0;
  transition: all 0.5s;
  -webkit-transition: all 0.5s;
}
.item-video:after {
  content: "\A";
  width: 100%;
  height: 100%;
  top: 0;
  left: 0;
  background: rgba(0, 0, 0, 0.6);
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
.item-video:hover:after,
.item-video:hover:before {
  opacity: 1;
}
.product-image {
  padding: 20px;
}
</style>
