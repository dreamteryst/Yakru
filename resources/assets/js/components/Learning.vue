<template>
    <section>
        <!-- BEGIN #product -->
        <div id="product" class="section-container p-t-20">
            <!-- BEGIN container -->
            <div class="container">

                <!-- BEGIN product -->
                <div class="product">
                    <!-- BEGIN product-detail -->
                    <div class="product-detail">
                        <!-- BEGIN product-image -->
                        <div class="product-image">
                            <h1 class="product-title">React Native สำหรับมือใหม่!!</h1><br/>
                            <div class="embed-responsive embed-responsive-16by9">
                                <!-- <video ref="videoElement"></video> -->
                                <iframe src="https://www.youtube.com/embed/mkualZPRZCs" frameborder="0" allow="autoplay; encrypted-media" allowfullscreen></iframe>
                            </div>
                        </div>
                        <!-- END product-image -->
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
                                                    <router-link to="#" :class="{'deactive-link': sub.isLearned}">
                                                        <i class="fa fa-play-circle"></i> {{ sub.name }}
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
                </div>
                <!-- END product -->

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
            courses: [
                {
                    title: "Setup and Introduction",
                    sub: [
                        {
                            name: "Course Introduction",
                            isLearned: true
                        },
                        {
                            name: "NodeJS Install",
                            isLearned: true
                        },
                        {
                            name: "React-Native & Watchman",
                            isLearned: true
                        },
                        {
                            name: "Visual Studio Install and React-Native Extension Pack",
                            isLearned: true
                        },
                        {
                            name: "React-Native CLI",
                            isLearned: true
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
                        }, {
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
                        }, {
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
    }
};
</script>

<style>

</style>
