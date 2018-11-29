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
                            <h1 class="product-title">{{ course.course_name }}</h1><br />
                            <div id="player" data-plyr-provider="youtube" :data-plyr-embed-id="youtube_parser(course.course_video)" v-if="course.course_video"></div>
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
                            <div class="tab-pane fade active in" id="curriculum" v-for="(unit, i) in course.units" :key="i" v-if="course.type === 'video'">
                                <b-card no-body class="mb-1">
                                    <b-card-header header-tag="header" class="p-1" role="tab">
                                        <b-btn block href="#" v-b-toggle="'accordion-' + i" variant="info" class="btn-left">
                                            <i class="fa fa-plus"></i>
                                            {{ unit.unit_name }}
                                        </b-btn>
                                    </b-card-header>
                                    <b-collapse :id="'accordion-' + i" accordion="my-accordion" role="tabpanel">
                                        <b-card-body>
                                            <ul class="curriculum" v-for="(lecture, j) in unit.lectures" :key="j">
                                                <li>
                                                    <a href="javascript:;" v-if="lecture.guest  || course.is_bought">
                                                        <i class="fa fa-play-circle"></i>
                                                        {{ lecture.lecture_name }}
                                                    </a>
                                                    <span v-else>
                                                        {{ lecture.lecture_name }}
                                                    </span>
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
            course: "",
            player: null
        };
    },
    mounted() {
        axios
            .get(`/api/course/${this.$route.params.id}`)
            .then(({ data }) => {
                this.course = data;
            })
            .catch(error => {
                console.log(error);
                if (error.response) console.log(error.response);
            });
        $(function () {
            new Plyr('#player')
        })
    }
};
</script>

<style>
</style>
