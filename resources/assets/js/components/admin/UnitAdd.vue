<template>
    <section>
        <!-- begin breadcrumb -->
        <ol class="breadcrumb pull-right">
            <li class="breadcrumb-item"><a href="/">Home</a></li>
            <li class="breadcrumb-item active">Add Unit</li>
        </ol>
        <!-- end breadcrumb -->
        <!-- begin page-header -->
        <h1 class="page-header">Add Unit <small></small></h1>
        <!-- end page-header -->

        <!-- begin panel -->
        <div class="panel panel-inverse">
            <!-- begin panel-heading -->
            <div class="panel-heading">
                <div class="panel-heading-btn">
                    <a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-warning" data-click="panel-collapse"><i class="fa fa-minus"></i></a>
                </div>
                <h4 class="panel-title">Form of Unit</h4>
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
                    <label for="unit_name">Unit Name</label>
                    <input type="text" class="form-control" id="unit_name" :class="{'is-invalid':isError('unit_name')}" v-model="unit_name" placeholder="Course Subtitle">
                    <div class="invalid-feedback" v-if="isError('unit_name')">
                        {{ errors.unit_name[0] }}
                    </div>
                </div>
                <div class="form-group">
                    <label for="lecture_name">Lecture</label>
                    <div class="col-md-2 offset-md-11 col-4 offset-9">
                        <i class="fa fa-plus fa-2x m-t-5" @click="addReq"></i>
                        <i class="fa fa-minus fa-2x m-t-5 m-l-5" @click="removeReq"></i>
                    </div>
                    <div class="row m-b-15" v-for="(req, j) in lecture_name" :key="j">
                        <div class="col-md-10">
                            <input class="form-control" v-model="lecture_name[j]" placeholder="Course lecture_name">
                        </div>
                         <div class="col-md-10">
                            <input type="file" @change="onFileChange($event,j)" class="form-control" :class="{'is-invalid':isError('video_name')}" id="video" accept="video/*" placeholder="Video file">
                        </div>
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
    data() {
        return {
            unit_name: '',
            lecture_name: [''],
            video_name:[''],
            video : '',
            errors: [],
            isSuccess : false,
        }
    },
    mounted() {
        axios.get(`/admin/api/category/data`).then((res) => {
            if (res.status === 200) {
                this.categories = res.data.data;
            }
        });
    },
    methods: {
        save() {
            const formData = new FormData();
            formData.append('lecture_name', this.lecture_name);
            formData.append('video_name', JSON.stringify(this.video_name));
            formData.append('unit_name', this.unit_name);
            
            axios.post(`/admin/api/unit`, formData).then((response) => {
                if (response.status === 200) {
                    this.unit_name = '';
                }
            })
                .catch((error) => {
                    this.errors = error.response.data.errors;
                    console.log(error.response)
                });
        },
        isError(field) {
            return this.errors[field] !== undefined;
        },
        addResult() {
            this.results.push('');

        },
        removeResult() {
            this.results.splice((this.results.length > 1) ? this.results.length - 1 : this.results.length - 0);
        },
        addReq() {
            this.lecture_name.push('');
            this.video_name.push('');
        },
        removeReq() {
            this.lecture_name.splice((this.lecture_name.length > 1) ? this.lecture_name.length - 1 : this.lecture_name.length - 0);
            this.video_name.splice((this.video_name.length > 1) ? this.video_name.length - 1 : this.video_name.length - 0);
        },
        onFileChange(event,j) {
            this.video = event.target.files[0]
            var formData = new FormData()
            formData.append('video',this.video)
    
            axios
                .post('/admin/api/unit/upload',formData)
                .then((res) => {
                    this.video_name[j] = res.data
                    console.log(res.data)
                })
        }
    }
}
</script>

<style>
</style>
