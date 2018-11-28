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
                        <form class="form-horizontal" name="contact_us_form" action="contact_us.html" method="POST">
                            <div class="form-group">
                                <label class="control-label col-md-3">ชื่อ นามสกุล <span class="text-danger">*</span></label>
                                <div class="col-md-7">
                                    <input type="text" class="form-control" name="name">
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="control-label col-md-3">เลขบัตรประชาชน <span class="text-danger">*</span></label>
                                <div class="col-md-7">
                                    <input type="text" class="form-control" name="citizen_id">
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="control-label col-md-3">วันเกิด <span class="text-danger">*</span></label>
                                <div class="col-md-7">
                                    <input type="text" class="form-control datetimepicker" name="date_of_birth">
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="control-label col-md-3">แนะนำตนเอง <span class="text-danger">*</span></label>
                                <div class="col-md-7">
                                    <textarea class="form-control" rows="5" name="bio"></textarea>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="control-label col-md-3">ความสามารถ <span class="text-danger">*</span></label>
                                <div class="col-md-7">
                                    <textarea class="form-control" rows="5" name="skill"></textarea>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="control-label col-md-3">แนบสำเนาบัตรประชาชน <span class="text-danger">*</span></label>
                                <div class="col-md-7">
                                    <input type="file" class="form-control" name="photi_id">
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="control-label col-md-3">ไฟล์อื่นๆ <span class="text-danger">*</span></label>
                                <div class="col-md-7">
                                    <input type="file" class="form-control" name="attach">
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
export default {
    mounted() {
        $(function() {
            $('.datetimepicker').datetimepicker({
                format: 'DD/MM/YYYY'
            });
        })
    }
}
</script>

<style>

</style>
