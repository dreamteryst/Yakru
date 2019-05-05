<template>
    <section>
        <!-- begin breadcrumb -->
        <ol class="breadcrumb pull-right">
            <li class="breadcrumb-item"><a href="/">หน้าแรก</a></li>
            <li class="breadcrumb-item active">เพิ่มคอร์ส</li>
        </ol>
        <!-- end breadcrumb -->
        <!-- begin page-header -->
        <h1 class="page-header">เพิ่มคอร์ส <small></small></h1>
        <!-- end page-header -->

        <!-- begin panel -->
        <div class="panel panel-inverse">
            <!-- begin panel-heading -->
            <div class="panel-heading">
                <div class="panel-heading-btn">
                    <a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-warning" data-click="panel-collapse"><i class="fa fa-minus"></i></a>
                </div>
                <h4 class="panel-title">เพิ่มคอร์ส</h4>
            </div>
            <!-- end panel-heading -->
            <!-- begin panel-body -->
            <div class="panel-body">
                <div class="alert alert-success fade show" v-if="isSuccess">
                    <span class="close" data-dismiss="alert">×</span>
                    <strong>สำเร็จ!</strong>
                    เพิ่มข้อมูลสำเร็จ
                </div>
                <div class="form-group">
                    <label for="category_id">หมวดหมู่</label>
                    <select class="form-control" :class="{'is-invalid':isError('category_id')}" id="category_id" v-model="category_id">
                        <option v-for="(category, i) in categories" :key="i" :value="category.id">{{ category.category_name }}</option>
                    </select>
                    <div class="invalid-feedback" v-if="isError('category_id')">
                        {{ errors.category_id[0] }}
                    </div>
                </div>
                <div class="form-group">
                    <label for="course_picture">ภาพปก</label>
                    <input type="file" class="form-control" :class="{'is-invalid':isError('course_picture')}" id="course_picture" @change="handlefile($event)" accept="image/*" placeholder="Course Cover">
                    <div class="invalid-feedback" v-if="isError('course_picture')">
                        {{ errors.course_picture[0] }}
                    </div>
                </div>
                <div class="form-group">
                    <label for="course_video">ลิงค์ intro</label>
                   <input type="text" class="form-control" :class="{'is-invalid':isError('course_video')}" id="course_video" v-model="course_video" placeholder="Course Video">
                    <div class="invalid-feedback" v-if="isError('course_video')">
                        {{ errors.course_video[0] }}
                    </div>
                </div>
                <div class="form-group">
                    <label for="course_name">ชื่อคอร์ส</label>
                    <input type="text" class="form-control" :class="{'is-invalid':isError('course_name')}" id="course_name" v-model="course_name" placeholder="Course Name">
                    <div class="invalid-feedback" v-if="isError('course_name')">
                        {{ errors.course_name[0] }}
                    </div>
                </div>
                <div class="form-group">
                    <label for="course_subtitle">คำอธิบายโดยย่อ</label>
                    <input type="text" class="form-control" id="course_subtitle" :class="{'is-invalid':isError('course_subtitle')}" v-model="course_subtitle" placeholder="Course Subtitle">
                    <div class="invalid-feedback" v-if="isError('course_subtitle')">
                        {{ errors.course_subtitle[0] }}
                    </div>
                </div>
                <div class="form-group">
                    <label for="course_description">รายละเอียดคอร์ส</label>
                    <textarea class="form-control" id="course_description" :class="{'is-invalid':isError('course_description')}" v-model="course_description" placeholder="Course Description" rows="15"></textarea>
                    <div class="invalid-feedback" v-if="isError('course_description')">
                        {{ errors.course_description[0] }}
                    </div>
                </div>
                <div class="form-group">
                    <label for="course_price">ราคา</label>
                    <input type="number" min="0" max="999999" step="0.01" class="form-control" id="course_price" :class="{'is-invalid':isError('course_price')}" v-model="course_price" placeholder="Course Price">
                    <div class="invalid-feedback" v-if="isError('course_price')">
                        {{ errors.course_price[0] }}
                    </div>
                </div>
                <div class="form-group">
                    <label for="course_discounted">ลดเหลือ</label>
                    <input type="number" min="0" max="999999" step="0.01" class="form-control" id="course_discounted" :class="{'is-invalid':isError('course_discounted')}" v-model="course_discounted" placeholder="Course Price">
                    <div class="invalid-feedback" v-if="isError('course_discounted')">
                        {{ errors.course_discounted[0] }}
                    </div>
                </div>
                <div class="form-group">
                    <label for="course_limit">จำนวนผู้เรียนได้สูงสุด</label>
                    <input type="number" min="0" max="999999" step="0.01" class="form-control" id="course_limit" :class="{'is-invalid':isError('course_limit')}" v-model="course_limit" placeholder="Course Price">
                    <div class="invalid-feedback" v-if="isError('course_limit')">
                        {{ errors.course_limit[0] }}
                    </div>
                </div>

                <div class="form-group">
                    <label for="requirements">ความรู้ที่ต้องนำมาใช้</label>
                    <div class="col-md-2 offset-md-11 col-4 offset-9">
                        <i class="fa fa-plus fa-2x m-t-5" @click="addReq"></i>
                        <i class="fa fa-minus fa-2x m-t-5 m-l-5" @click="removeReq"></i>
                    </div>
                    <div class="row m-b-15" v-for="(req, j) in requirements" :key="j">
                        <div class="col-md-10">
                            <input class="form-control" v-model="requirements[j]" placeholder="Course Requirements">
                        </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="result">ผลลัพธ์ที่คาดว่าจะได้จากการเรียน</label>
                        <div class="col-md-2 offset-md-11 col-4 offset-9">
                            <i class="fa fa-plus fa-2x m-t-5" @click="addResult"></i>
                            <i class="fa fa-minus fa-2x m-t-5 m-l-5" @click="removeResult"></i>
                        </div>
                        <div class="row m-b-15" v-for="(result, i) in results" :key="i">
                            <div class="col-md-10">
                                <input class="form-control" v-model="results[i]" placeholder="Course Result">
                        </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="tags">แท็ก</label>
                            <input-tag type="text" class="form-control" id="tags" :class="{'is-invalid':isError('tags')}" :tags.sync="tags" placeholder="Tags" addTagOnBlur :addTagOnKeys="[13,188,9,32]" />
                        </div>
                        <div class="form-group">
                            <label>ประเภท</label>
                            <div class="radio radio-css radio-inline">
                                <input v-model="type" type="radio" id="type-video" value="video" name="type" />
                                <label for="type-video">Video</label>
                            </div>
                            <div class="radio radio-css radio-inline">
                                <input v-model="type" type="radio" id="type-live" value="live" name="type" />
                                <label for="type-live">Live Streaming</label>
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
    data() {
        return {
            categories: [],
            category_id: '',
            course_name: '',
            course_subtitle: '',
            course_description: '',
            course_price: '',
            requirements: [''],
            results: [''],
            tags: [],
            errors: [],
            isSuccess: false,
            picture : '',
            course_video : '',
            course_discounted : 0,
            course_limit: '',
            type : ''
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
            formData.append('category_id', this.category_id);
            formData.append('course_name', this.course_name);
            formData.append('course_subtitle', this.course_subtitle);
            formData.append('course_description', this.course_description);
            formData.append('course_price', this.course_price);
            formData.append('requirements', JSON.stringify(this.requirements));
            formData.append('results', JSON.stringify(this.results));
            formData.append('tags', JSON.stringify(this.tags));
            formData.append('course_picture', this.picture,this.picture.name);
            formData.append('course_video', this.course_video);
            formData.append('course_discounted', this.course_discounted);
            formData.append('course_limit', this.course_limit);
            formData.append('type', this.type);
            
            axios.post(`/admin/api/course`, formData).then((response) => {
                if (response.status === 200) {
                    this.course_name = '';
                    this.category_id = '';
                    this.course_subtitle = '';
                    this.course_description = '';
                    this.course_price = '';
                    this.requirements = [''];
                    this.results = [''];
                    this.isSuccess = true;
                    this.tags = [];
                    this.errors = [];
                    this.picture = '';
                    this.course_video = '';
                    this.course_discounted = 0;
                    this.course_limit = '';
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
            this.requirements.push('');
        },
        removeReq() {
            this.requirements.splice((this.requirements.length > 1) ? this.requirements.length - 1 : this.requirements.length - 0);
        },
        handlefile(event) {
            this.picture = event.target.files[0];
        }
    }
}
</script>

<style>
</style>
