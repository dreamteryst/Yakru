<template>
    <section>
        <!-- begin breadcrumb -->
        <ol class="breadcrumb pull-right">
            <li class="breadcrumb-item"><a href="/">Home</a></li>
            <li class="breadcrumb-item active">Add Course</li>
        </ol>
        <!-- end breadcrumb -->
        <!-- begin page-header -->
        <h1 class="page-header">Add Course <small></small></h1>
        <!-- end page-header -->
        
        <!-- begin panel -->
        <div class="panel panel-inverse">
            <!-- begin panel-heading -->
            <div class="panel-heading">
                <div class="panel-heading-btn">
                    <a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-warning" data-click="panel-collapse"><i class="fa fa-minus"></i></a>
                </div>
                <h4 class="panel-title">List of Course</h4>
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
                    <label for="category_id">Category</label>
                    <select class="form-control" id="category_id">
                        <option>test</option>
                    </select>
                </div>
                <div class="form-group">
                    <label for="course_name">Course Name</label>
                    <input type="text" class="form-control" :class="{'is-invalid':isError('course_name')}" id="course_name" v-model="course_name" placeholder="Course Name">
                    <div class="invalid-feedback" v-if="isError('course_name')">
                        {{ errors.course_name[0] }}
                    </div>
                </div>
                <div class="form-group">
                    <label for="course_subtitle">Course Subtitle</label>
                    <input type="text" class="form-control" id="course_subtitle" :class="{'is-invalid':isError('course_subtitle')}" v-model="course_subtitle" placeholder="Course Subtitle">
                    <div class="invalid-feedback" v-if="isError('course_subtitle')">
                        {{ errors.course_subtitle[0] }}
                    </div>
                </div>
                <div class="form-group">
                    <label for="course_description">Course Description</label>
                    <textarea class="form-control" id="course_description" :class="{'is-invalid':isError('course_description')}" v-model="course_description" placeholder="Course Description" rows="15"></textarea>
                    <div class="invalid-feedback" v-if="isError('course_description')">
                        {{ errors.course_description[0] }}
                    </div>
                </div>
                <div class="form-group">
                    <label for="course_price">Course Price</label>
                    <input type="number" min="0" max="999999" class="form-control" id="course_price" :class="{'is-invalid':isError('course_price')}" v-model="course_price" placeholder="Course Price">
                    <div class="invalid-feedback" v-if="isError('course_price')">
                        {{ errors.course_price[0] }}
                    </div>
                </div>
                <div class="pull-right">
                    <button class="btn btn-primary" @click="save"><i class="fa fa-paper-plane"></i> Save</button>
                </div>
            </div>
        </div>
    </section>
</template>

<script>
export default {
    data(){
        return {
            category_id: '',
            course_name: '',
            course_subtitle : '',
            course_description : '',
            course_price: '',
            requirements: '',
            result: '',
            errors: [],
            isSuccess:false,
        }
    },
    methods:{
        save(){
            const formData = new FormData();
            formData.append('category_id', this.category_id);
            formData.append('course_name', this.course_name);

            axios.post(`//${window.location.host}/api/category`, formData).then((response)=>{
                console.log(response)
                if(response.status === 200) {
                    this.categoryName = '';
                    this.description = '';
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
        }
    }
}
</script>

<style>

</style>
