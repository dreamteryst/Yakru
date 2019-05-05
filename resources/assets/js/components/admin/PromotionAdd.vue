<template>
    <section>
        <!-- begin breadcrumb -->
        <ol class="breadcrumb pull-right">
            <li class="breadcrumb-item"><a href="/">หน้าแรก</a></li>
            <li class="breadcrumb-item active">เพิ่มโปรโมชัน</li>
        </ol>
        <!-- end breadcrumb -->
        <!-- begin page-header -->
        <h1 class="page-header">เพิ่มโปรโมชัน <small></small></h1>
        <!-- end page-header -->
        
        <!-- begin panel -->
        <div class="panel panel-inverse">
            <!-- begin panel-heading -->
            <div class="panel-heading">
                <div class="panel-heading-btn">
                    <a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-warning" data-click="panel-collapse"><i class="fa fa-minus"></i></a>
                </div>
                <h4 class="panel-title">รายการโปรโมชัน</h4>
            </div>
            <!-- end panel-heading -->
            <!-- begin panel-body -->
            <div class="panel-body">
                <div class="alert alert-success fade show" v-if="isSuccess">
                    <span class="close" data-dismiss="alert">×</span>
                    <strong>Success!</strong>
                    เพิ่มข้อมูลสำเร็จ
                </div>
                <div class="form-group">
                    <label for="promotion_name">ชื่อโปรโมชัน</label>
                    <input type="text" class="form-control" :class="{'is-invalid':isError('promotion_name')}" id="promotion_name" v-model="promotion_name" placeholder="Promotion Name">
                    <div class="invalid-feedback" v-if="isError('promotion_name')">
                        {{ errors.promotion_name[0] }}
                    </div>
                </div>
                <div class="form-group">
                    <label for="promotion_description">รายละเอียดโปรโมชัน</label>
                    <textarea class="form-control" id="description" :class="{'is-invalid':isError('promotion_description')}" v-model="promotion_description" placeholder="Description" rows="10"></textarea>
                    <div class="invalid-feedback" v-if="isError('promotion_description')">
                        {{ errors.promotion_description[0] }}
                    </div>
                </div>
                <div class="form-group">
                    <label for="discount">ส่วนลด</label>
                    <input type="number" class="form-control" :class="{'is-invalid':isError('discount')}" id="discount" v-model="discount" placeholder="Discount">
                    <div class="invalid-feedback" v-if="isError('discount')">
                        {{ errors.discount[0] }}
                    </div>
                </div>
                <div class="form-group row m-b-15">
                    <label class="col-form-label col-md-2">วันเริ่มต้น</label>
                    <div class="col-md-10">
                        <input type="text" class="form-control m-b-5 datetimepicker" :class="{'is-invalid':isError('started_at')}" @blur="handledate($event,1)" placeholder="Enter date" />
                        <div class="invalid-feedback" v-if="isError('started_at')">
                            {{ errors.started_at[0] }}
                        </div>
                    </div>
                </div>
                <div class="form-group row m-b-15">
                    <label class="col-form-label col-md-2">วันสิ้นสุด</label>
                    <div class="col-md-10">
                        <input type="text" class="form-control m-b-5 datetimepicker" :class="{'is-invalid':isError('ended_at')}" @blur="handledate($event,1)" placeholder="Enter date" />
                        <div class="invalid-feedback" v-if="isError('ended_at')">
                            {{ errors.ended_at[0] }}
                        </div>
                    </div>
                </div>
                <div class="pull-right">
                    <button class="btn btn-primary" @click="save"><i class="fa fa-paper-plane"></i> บันทึก</button>
                </div>
            </div>
        </div>
    </section>
</template>

<script>
export default {
    data(){
        return {
            promotion_name: '',
            promotion_description: '',
            discount : '',
            ended_at : '',
            started_at : '',
            errors: [],
            isSuccess:false,
        }
    },
    mounted(){
        $('.datetimepicker').datetimepicker({
            format: 'YYYY-MM-DD hh:mm:ss'
        });
        this.started_at = $('.datetimepicker').val()
        this.ended_at = $('.datetimepicker').val()
    },
    methods:{
        save(){
            const formData = new FormData();
            formData.append('promotion_name', this.promotion_name);
            formData.append('promotion_description', this.promotion_description);
            formData.append('discount', this.discount);
            formData.append('started_at', this.started_at);
            formData.append('ended_at', this.ended_at);

            axios.post(`/admin/api/promotion`, formData).then((response)=>{
                console.log(response)
                if(response.status === 200) {
                    this.promotion_name = '';
                    this.promotion_description = '';
                    this.discount = '';
                    this.started_at = '';
                    this.ended_at = '';
                    this.isSuccess = true;
                    this.errors = [];
                }
            })
            .catch((error) => {
                this.errors = error.response.data.errors;
                console.log(error.response)
            });
        },
        isError(field){
            return this.errors[field] !== undefined;
        },
        handledate(event,type) {
            switch(type){
                case 1 : this.started_at = event.target.value;
                case 2 : this.ended_at = event.target.value;
            }
        },
    }

};
</script>

<style>
</style>
