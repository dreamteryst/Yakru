<template>
    <section>
        <!-- begin breadcrumb -->
        <ol class="breadcrumb pull-right">
            <li class="breadcrumb-item"><a href="/">Home</a></li>
            <li class="breadcrumb-item active">Add Category</li>
        </ol>
        <!-- end breadcrumb -->
        <!-- begin page-header -->
        <h1 class="page-header">Add Category <small></small></h1>
        <!-- end page-header -->
        
        <!-- begin panel -->
        <div class="panel panel-inverse">
            <!-- begin panel-heading -->
            <div class="panel-heading">
                <div class="panel-heading-btn">
                    <a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-warning" data-click="panel-collapse"><i class="fa fa-minus"></i></a>
                </div>
                <h4 class="panel-title">List of Category</h4>
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
                    <label for="categoryName">Category Name</label>
                    <input type="text" class="form-control" :class="{'is-invalid':isError('category_name')}" id="categoryName" v-model="categoryName" placeholder="Category Name">
                    <div class="invalid-feedback" v-if="isError('category_name')">
                        {{ errors.category_name[0] }}
                    </div>
                </div>
                <div class="form-group">
                    <label for="description">Description</label>
                    <textarea class="form-control" id="description" :class="{'is-invalid':isError('category_description')}" v-model="description" placeholder="Description" rows="10"></textarea>
                    <div class="invalid-feedback" v-if="isError('category_description')">
                        {{ errors.category_description[0] }}
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
            categoryName: '',
            description: '',
            errors: [],
            isSuccess:false,
        }
    },
    methods:{
        save(){
            const formData = new FormData();
            formData.append('category_name', this.categoryName);
            formData.append('category_description', this.description);

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

};
</script>

<style>
</style>
