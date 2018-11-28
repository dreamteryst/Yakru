<template>
    <section>
        <!-- begin breadcrumb -->
        <ol class="breadcrumb pull-right">
            <li class="breadcrumb-item"><a href="/">Home</a></li>
            <li class="breadcrumb-item active">จัดการโปรโมชัน</li>
        </ol>
        <!-- end breadcrumb -->
        <!-- begin page-header -->
        <h1 class="page-header">จัดการโปรโมชัน <small></small></h1>
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
                <table id="promotion-table" class="table table-striped table-bordered">
                    <thead>
                        <tr>
                            <th width="1%" data-priority="1">ID</th>
                            <th class="text-nowrap">ชื่อโปรโมชัน</th>
                            <th class="text-nowrap">รายละเอียด</th>
                            <th class="text-nowrap">ส่วนลด (%)</th>
                            <th class="text-nowrap">เริ่มต้น</th>
                            <th class="text-nowrap">สิ้นสุด</th>
                            <th class="text-nowrap">คอร์สที่ร่วม</th>
                            <th width="1%" class="text-nowrap" data-priority="1">Actions</th>
                        </tr>
                    </thead>
                </table>
            </div>
        </div>
        <b-modal ref="modalCourseList" size="lg" title="รายชื่อคอร์ส">
            <table class="table table-striped table-bordered">
                <thead>
                    <tr>
                        <th>ชื่อคอร์ส</th>
                        <th>คำอธิบาย</th>
                        <th>รายละเอียด</th>
                        <th>ราคา</th>
                        <th>เหลือ</th>
                    </tr>
                </thead>
                <tbody>
                    <tr v-for="(course, i) in courses" :key="i">
                        <td>{{ course.course_name }}</td>
                        <td>{{ course.course_subtitle }}</td>
                        <td>{{ course.course_description }}</td>
                        <td>{{ numberWithCommas(course.course_price) }}</td>
                        <td>{{ numberWithCommas(getPrice(data.discount, course.course_price)) }}</td>
                    </tr>
                </tbody>
            </table>
        </b-modal>
         <b-modal id="modal1" v-model="modalDelete" size="lg" @ok="deleteData" ok-title="Delete" ok-variant="danger" :title="'Delete '+data.promotion_name" @hidden="onHidden">
            <div class="alert alert-danger fade show" v-if="isError('delete')">
                <span class="close" data-dismiss="alert">×</span>
                <strong>Error!</strong>
                {{ errors.delete }}
            </div>
            <div class="table-responsive">
                <table class="table table-bordered">
                    <tr>
                        <th width="1%" data-priority="1">ID</th>
                        <th class="text-nowrap">ชื่อโปรโมชัน</th>
                        <th class="text-nowrap">รายละเอียด</th>
                        <th class="text-nowrap">ส่วนลด (%)</th>
                        <th class="text-nowrap">เริ่มต้น</th>
                        <th class="text-nowrap">สิ้นสุด</th>
                    </tr>
                    <tr>
                        <td>{{ data.id }}</td>
                        <td>{{ data.promotion_name }}</td>
                        <td>{{ data.promotion_description }}</td>
                        <td>{{ data.discount }}</td>
                        <td>{{ data.started_at }}</td>
                        <td>{{ data.ended_at }}</td>
                    </tr>
                </table>
            </div>
        </b-modal>
        <b-modal id="modalNewEdit" v-model="modalEdit" size="lg" @ok="editData" ok-title="Edit" ok-variant="success" :title="'Edit '+data.promotion_name" @hidden="onHidden">
            <div class="alert alert-danger fade show" v-if="isError('message')">
                <span class="close" data-dismiss="alert">×</span>
                <strong>Error!</strong>
                {{ errors.message }}
            </div>
            <div class="form-group">
                <label for="promotion_name">Promotion Name</label>
                <input type="text" class="form-control" :class="{'is-invalid':isError('promotion_name')}" id="promotion_name" v-model="data.promotion_name" placeholder="Promotion Name">
                <div class="invalid-feedback" v-if="isError('promotion_name')">
                    {{ errors.promotion_name[0] }}
                </div>
            </div>
            <div class="form-group">
                <label for="promotion_description">Promotion Description</label>
                <textarea class="form-control" id="description" :class="{'is-invalid':isError('promotion_description')}" v-model="data.promotion_description" placeholder="Description" rows="10"></textarea>
                <div class="invalid-feedback" v-if="isError('promotion_description')">
                    {{ errors.promotion_description[0] }}
                </div>
            </div>
            <div class="form-group">
                <label for="discount">Discount</label>
                <input type="number" class="form-control" :class="{'is-invalid':isError('discount')}" id="discount" v-model="data.discount" placeholder="Discount">
                <div class="invalid-feedback" v-if="isError('discount')">
                    {{ errors.discount[0] }}
                </div>
            </div>
            <div class="form-group row m-b-15">
                <label class="col-form-label col-md-2">Promotion Start Date</label>
                <div class="col-md-10">
                    <input v-model="data.started_at"  type="text" class="form-control m-b-5 datetimepicker" :class="{'is-invalid':isError('started_at')}" @blur="handledate($event,1)" placeholder="Enter date" />
                    <div class="invalid-feedback" v-if="isError('started_at')">
                        {{ errors.started_at[0] }}
                    </div>
                </div>
            </div>
            <div class="form-group row m-b-15">
                <label class="col-form-label col-md-2">Promotion End Date</label>
                <div class="col-md-10">
                    <input v-model="data.ended_at"  type="text" class="form-control m-b-5 datetimepicker" :class="{'is-invalid':isError('ended_at')}" @blur="handledate($event,2)" placeholder="Enter date" />
                    <div class="invalid-feedback" v-if="isError('ended_at')">
                        {{ errors.ended_at[0] }}
                    </div>
                </div>
            </div>
        </b-modal>
    </section>
</template>

<script>
export default {
    data() {
        return {
            modalDelete: false,
            modalEdit: false,
            courses: [],
            errors: [],
            data: {
            },
            promotion_name : '',
            promotion_description : '',
            discount : '',
            started_at : '',
            ended_at : ''
        }
    },
    mounted() {
        $('.datetimepicker').datetimepicker({
            format: 'YYYY-MM-DD hh:mm:ss'
        });
        var self = this;
        $(function () {
            self.table = $("#promotion-table").DataTable({
                responsive: true,
                autoWidth: false,
                processing: true,
                serverSide: true,
                ajax: `/admin/api/promotion/data`,
                order: [[0, "desc"]],
                rowCallback: function (row, data, index) {
                    if (data["deleted_at"] != null) {
                        $(row).addClass("danger");
                    }
                },
                columns: [
                    { data: "id", name: "id" },
                    { data: "promotion_name", name: "promotion_name" },
                    { data: "promotion_description", name: "promotion_description" },
                    { data: "discount", name: "discount" },
                    { data: "started_at", name: "started_at" },
                    { data: "ended_at", name: "ended_at" },
                    { 
                        data: null,
                        searchable: false,
                        sortable: false,
                        render: (data, type, row, meta) => {
                            const course = row['course'];
                            delete row['course']
                            return `<a href="javascript:;" class="view-course" data-promotion="${escape(JSON.stringify(row))}" data-course="${escape(JSON.stringify(course))}">ดูรายการ</a>`
                        }
                    },
                    {
                        data: null,
                        render: (data, type, row, meta) => {
                            return (
                                `
                          <div class="actions" data-id='` +
                                JSON.stringify(row) +
                                `'>
                            <i class="fa fa-edit new-user-edit"></i>
                            <i class="fa fa-trash-alt"></i>
                          </div>`
                            );
                        },
                        searchable: false,
                        sortable: false
                    }
                ],
                drawCallback: function (settings) {
                    $(".view-course").on("click", function () {
                        self.courses = JSON.parse(
                            unescape($(this).attr("data-course"))
                        );
                        self.data = JSON.parse(
                            unescape($(this).attr("data-promotion"))
                        );
                        self.$refs.modalCourseList.show();
                    });
                    $(".fa-edit").on("click", function () {
                        self.data = JSON.parse(
                            $(this)
                                .closest("div")
                                .attr("data-id")
                        );
                        self.modalEdit = true;
                    });

                    $(".fa-trash-alt").on("click", function () {
                        self.data = JSON.parse(
                            $(this)
                                .closest("div")
                                .attr("data-id")
                        );
                        self.modalDelete = true;
                    });
                    $(".fa-undo").on("click", function () {
                        self.data = JSON.parse(
                            $(this)
                                .closest("div")
                                .attr("data-id")
                        );
                        self.deleteData();
                    });
                }
            });
        });
    },
    methods : {
        deleteData(evt) {
            if (evt != undefined) evt.preventDefault();
            axios
                .post(`/admin/api/promotion` + "/" + this.data.id, {
                    _method: "DELETE"
                })
                .then(res => {
                    this.modalDelete = false;
                    this.errors = {};
                    this.table.ajax.reload();
                })
                .catch(res => {
                    this.errors = res.response.data.errors;
                    this.errors.message = res.response.data.message;
                });
        },
        editData(evt) {
            evt.preventDefault();
            
            var formData = new FormData();
            formData.append("_method", "PUT");
            formData.append('promotion_name', this.data.promotion_name);
            formData.append('promotion_description', this.data.promotion_description);
            formData.append('discount', this.data.discount);
            formData.append('started_at', this.data.started_at);
            formData.append('ended_at', this.data.ended_at);

            axios
                .post(`/admin/api/promotion` + "/" + this.data.id, formData)
                .then(res => {
                    this.modalEdit = false;
                    this.errors = {};
                    this.table.ajax.reload();
                })
                .catch(res => {
                    this.errors = res.response.data.errors;
                    this.errors.message = res.response.data.message;
                });
        },
        onHidden(evt) {
            this.errors = {};
        },
        handledate(event,type) {
            switch(type){
                case 1 : this.data.started_at = event.target.value;
                case 2 : this.data.ended_at = event.target.value;
            }
        },
    }
}
</script>

<style>

</style>
