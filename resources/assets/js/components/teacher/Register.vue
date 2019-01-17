<template>
    <section>
        <div id="page-header" class="section-container page-header-container bg-black">
            <!-- BEGIN page-header-cover -->
            <div class="page-header-cover">
                <img src="/assets/img/cover/cover-15.jpg" alt="">
            </div>
            <!-- END page-header-cover -->
            <!-- BEGIN container -->
            <div class="container">
                <h1 class="page-header">สมัครเป็นผู้สอน</h1>
            </div>
            <!-- END container -->
        </div>
        <div id="product" class="section-container p-t-20 bg-white">
            <!-- BEGIN container -->
            <div class="container">
                <!-- BEGIN breadcrumb -->
                <ul class="breadcrumb m-b-10 f-s-18">
                    <li><a href="#">Home</a></li>
                    <li><a href="#">Teacher</a></li>
                    <li class="active">สมัครเป็นผู้สอน</li>
                </ul>
                <!-- END breadcrumb -->
                <!-- BEGIN row -->
                <div class="row row-space-30">
                    <!-- BEGIN col-8 -->
                    <div class="col-md-8">
                        <h4 class="m-t-0">ฟอร์มสมัครเป็นผู้สอน</h4>
                        <form class="form-horizontal" name="contact_us_form" action="contact_us.html" method="POST" @submit="submit">
                            <div class="form-group">
                                <label class="control-label col-md-3">ชื่อ นามสกุล <span class="text-danger">*</span></label>
                                <div class="col-md-7">
                                    <input type="text" class="form-control" name="name" v-model="name">
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="control-label col-md-3">เลขบัตรประชาชน <span class="text-danger">*</span></label>
                                <div class="col-md-7">
                                    <input type="text" class="form-control" name="citizen_id" v-model="citizen_id">
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="control-label col-md-3">วันเกิด <span class="text-danger">*</span></label>
                                <div class="col-md-7">
                                    <input type="text" class="form-control datetimepicker" name="date_of_birth" v-model="date_of_birth">
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="control-label col-md-3">แนะนำตนเอง <span class="text-danger">*</span></label>
                                <div class="col-md-7">
                                    <textarea class="form-control" rows="5" name="bio" v-model="bio"></textarea>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="control-label col-md-3">ความสามารถ <span class="text-danger">*</span></label>
                                <div class="col-md-7">
                                    <textarea class="form-control" rows="5" name="skill" v-model="skill"></textarea>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="control-label col-md-3">แนบสำเนาบัตรประชาชน <span class="text-danger">*</span></label>
                                <div class="col-md-7">
                                    <input type="file" class="form-control" name="photo_id" @change="handlePhotoId">
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="control-label col-md-3">ไฟล์อื่นๆ</label>
                                <div class="col-md-7">
                                    <input type="file" class="form-control" name="attach" @change="handleAttach">
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="control-label col-md-3"></label>
                                <div class="col-md-7">
                                    <button type="submit" class="btn btn-inverse btn-lg">สมัคร</button>
                                </div>
                            </div>
                        </form>
                    </div>
                    <!-- END col-8 -->
                    <!-- BEGIN col-4 -->
                    <div class="col-md-4">

                    </div>
                    <!-- END col-4 -->
                </div>
                <!-- END row -->
            </div>
            <!-- END row -->
        </div>
    </section>
</template>

<script>
import swal from 'sweetalert2'
export default {
    data() {
        return {
            name: '',
            citizen_id: '',
            date_of_birth: '',
            bio: '',
            skill: '',
            photo_id: '',
            attach: ''
        }
    },
    mounted() {
        const self = this;
        $(function () {
            $('.datetimepicker').datetimepicker({
                format: 'DD/MM/YYYY'
            });
            $(".datetimepicker").on("dp.change", function (e) {
                self.date_of_birth = e.date.format("DD/MM/YYYY");
            });
        })
    },
    methods: {
        handlePhotoId(event) {
            this.photo_id = event.target.files[0]
        },
        handleAttach(event) {
            this.attach = event.target.files[0]
        },
        submit(event) {
            event.preventDefault();
            if (!validateThaiCitizenID(this.citizen_id)) {
                return swal({
                    type: "error",
                    title: "Oops...",
                    text: 'เลขบัตรประชาชนไม่ถูกต้อง'
                });
            }
            const data = new FormData();
            data.append('name', this.name)
            data.append('citizen_id', this.citizen_id)
            data.append('date_of_birth', this.date_of_birth)
            data.append('bio', this.bio)
            data.append('skill', this.skill)
            data.append('photo_id', this.photo_id, this.photo_id.name)
            data.append('attach', this.attach, this.attach.name)

            axios.post('/api/teacher/register', data).then(({ data }) => {
                swal({
                    type: "success",
                    title: "ดำเนินการสำเร็จ"
                });
            })
                .catch(error => {
                    console.log(error);
                    if (error.response) {
                        console.log(error.response);
                        swal({
                            type: "error",
                            title: "Oops...",
                            text: error.response.data.message
                        });
                    }
                });

        }
    }
}
</script>

<style>
</style>
