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
                    <input type="text" class="form-control" id="unit_name" :class="{'is-invalid':isError('unit_name')}" v-model="unit_name" placeholder="Unit name">
                    <div class="invalid-feedback" v-if="isError('unit_name')">
                        {{ errors.unit_name[0] }}
                    </div>
                </div>
                <div class="form-group">
                    <label for="lecture">Lecture</label>
                    <div class="col-md-2 offset-md-11 col-4 offset-9">
                        <i class="fa fa-plus fa-2x m-t-5" @click="addLecture"></i>
                        <i class="fa fa-minus fa-2x m-t-5 m-l-5" @click="removeLecture"></i>
                    </div>
                    <div class="row m-b-15" v-for="(lec, j) in lectures" :key="j">
                        <div class="col-md-2">
                            <b-form-select :options="options" v-model="lectures[j].type"></b-form-select>
                        </div>
                        <div class="col-md-6">
                            <input class="form-control" v-model="lectures[j].name" placeholder="Lecture name">
                        </div>
                         <div class="col-md-3" v-if="lectures[j].type === 'youtube'">
                            <b-form-input v-model="lectures[j].url" placeholder="ลิงค์ Youtube" />
                        </div>
                        <div class="col-md-3" v-else>
                            <input type="file" @change="onFileChange($event,j)" class="form-control" :class="{'is-invalid':isError('video_name')}" id="video" accept="video/*" placeholder="Video file">
                        </div>
                        <div class="col-md-1">
                            <b-form-checkbox v-model="lectures[j].guest" :value="true">Public</b-form-checkbox>
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
            lectures: [{
                type: 'youtube',
                name: '',
                video: '',
                url: '',
                guest: false
            }],
            errors: [],
            isSuccess : false,
            options: [
                { value: 'youtube', text: 'Youtube'},
                { value: 'video', text: 'Video File' }
            ]
        }
    },
    methods: {
        save() {
            const formData = new FormData();
            formData.append('unit_name', this.unit_name);
            formData.append('course_id', this.$route.params.id);
            this.lectures.map((item, i) => {
                formData.append(`lectures[${i}][type]`, item.type)
                formData.append(`lectures[${i}][name]`, item.name)
                formData.append(`lectures[${i}][guest]`, item.guest)
                formData.append(`lectures[${i}][url]`, item.url)
                formData.append(`lectures[${i}][video]`, item.video, item.video.name)
            })

            axios.post(`/admin/api/unit`, formData).then((response) => {
                if (response.status === 200) {
                    window.location.href = `/admin/course/unit/${this.$route.params.id}`
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
        addLecture() {
            this.lectures.push({
                type: 'youtube',
                name: '',
                video: '',
                url: '',
                guest: false
            });
        },
        removeLecture() {
            this.lectures.splice((this.lectures.length > 1) ? this.lectures.length - 1 : this.lectures.length - 0);
        },
        onFileChange(event,j) {
            this.lectures[j].video = event.target.files[0]
        }
    }
}
</script>

<style>
</style>
