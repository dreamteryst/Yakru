<template>
    <section>
        <!-- begin breadcrumb -->
        <ol class="breadcrumb pull-right">
            <li class="breadcrumb-item"><a href="/">หน้าแรก</a></li>
            <li class="breadcrumb-item active">จัดการคอร์ส</li>
        </ol>
        <!-- end breadcrumb -->
        <!-- begin page-header -->
        <h1 class="page-header"> จัดการคอร์ส <small></small></h1>
        <!-- end page-header -->

        <!-- begin panel -->
        <div class="panel panel-inverse">
            <!-- begin panel-heading -->
            <div class="panel-heading">
                <div class="panel-heading-btn">
                    <a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-warning" data-click="panel-collapse"><i class="fa fa-minus"></i></a>
                </div>
                <h4 class="panel-title">รายการคอร์สทั้งหมด</h4>
            </div>
            <!-- end panel-heading -->
            <!-- begin panel-body -->
            <div class="panel-body">
                <table id="course-table" class="table table-striped table-bordered">
                    <thead>
                        <tr>
                            <th width="1%" data-priority="1">ID</th>
                            <th class="text-nowrap">ผู้สอน</th>
                            <th class="text-nowrap">ชื่อคอร์ส</th>
                            <th class="text-nowrap">หมวดหมู่</th>
                            <th class="text-nowrap">คำอธิบายโดยย่อ</th>
                            <th class="text-nowrap">จำนวนผู้เรียน</th>
                            <th class="text-nowrap">ราคา</th>
                            <th class="text-nowrap">จัดการ</th>
                            <th width="1%" class="text-nowrap" data-priority="1">Actions</th>
                        </tr>
                    </thead>
                </table>
            </div>
        </div>

        <b-modal id="modal1" v-model="modalDelete" size="lg" @ok="deleteData" ok-title="Delete" ok-variant="danger" :title="'Delete '+data.course_name" @hidden="onHidden">
            <div class="alert alert-danger fade show" v-if="isError('delete')">
                <span class="close" data-dismiss="alert">×</span>
                <strong>Error!</strong>
                {{ errors.delete }}
            </div>
            <div class="table-responsive">
                <table class="table table-bordered">
                    <tr>
                        <th width="1%">ID</th>
                        <th class="text-nowrap">Course Name</th>
                    </tr>
                    <tr>
                        <td>{{ data.id }}</td>
                        <td>{{ data.course_name }}</td>
                    </tr>
                </table>
            </div>
        </b-modal>
        <b-modal id="modalNewEdit" v-model="modalEdit" size="lg" @ok="editData" ok-title="Edit" ok-variant="success" :title="'Edit '+data.course_name" @hidden="onHidden">
            <div class="alert alert-danger fade show" v-if="isError('message')">
                <span class="close" data-dismiss="alert">×</span>
                <strong>Error!</strong>
                {{ errors.message }}
            </div>
            <div class="form-group">
                <label for="category_id">Category</label>
                <select class="form-control" :class="{'is-invalid':isError('category_id')}" id="category_id" v-model="data.category_id">
                    <option v-for="(category, i) in categories" :key="i" :value="category.id" :selected="category.id == data.category_id">{{ category.category_name }}</option>
                </select>
                <div class="invalid-feedback" v-if="isError('category_id')">
                    {{ errors.category_id[0] }}
                </div>
            </div>
            <div class="form-group">
                <label for="course_name">Course Name</label>
                <input type="text" class="form-control" :class="{'is-invalid':isError('course_name')}" id="course_name" v-model="data.course_name" placeholder="Course Name">
                <div class="invalid-feedback" v-if="isError('course_name')">
                    {{ errors.course_name[0] }}
                </div>
            </div>
            <div class="form-group">
                <label for="course_subtitle">Course Subtitle</label>
                <input type="text" class="form-control" id="course_subtitle" :class="{'is-invalid':isError('course_subtitle')}" v-model="data.course_subtitle" placeholder="Course Subtitle">
                <div class="invalid-feedback" v-if="isError('course_subtitle')">
                    {{ errors.course_subtitle[0] }}
                </div>
            </div>
            <div class="form-group">
                <label for="course_description">Course Description</label>
                <textarea class="form-control" id="course_description" :class="{'is-invalid':isError('course_description')}" v-model="data.course_description" placeholder="Course Description" rows="15"></textarea>
                <div class="invalid-feedback" v-if="isError('course_description')">
                    {{ errors.course_description[0] }}
                </div>
            </div>
            <div class="form-group">
                <label for="course_price">Course Price</label>
                <input type="number" min="0" max="999999" class="form-control" id="course_price" :class="{'is-invalid':isError('course_price')}" v-model="data.course_price" placeholder="Course Price">
                <div class="invalid-feedback" v-if="isError('course_price')">
                    {{ errors.course_price[0] }}
                </div>
            </div>
            <div class="form-group">
                <label for="course_discounted">Course Discounted</label>
                <input type="number" min="0" max="999999" class="form-control" id="course_discounted" :class="{'is-invalid':isError('course_discounted')}" v-model="data.course_discounted" placeholder="Course Price">
                <div class="invalid-feedback" v-if="isError('course_discounted')">
                    {{ errors.course_discounted[0] }}
                </div>
            </div>
            <div class="form-group">
                <label for="course_limit">Course Limit</label>
                <input type="number" min="0" max="999999" class="form-control" id="course_limit" :class="{'is-invalid':isError('course_limit')}" v-model="data.course_limit" placeholder="Course Price">
                <div class="invalid-feedback" v-if="isError('course_limit')">
                    {{ errors.course_limit[0] }}
                </div>
            </div>

            <div class="form-group">
                <label for="requirements">Course Requirements</label>
                <div class="col-md-2 offset-md-11 col-4 offset-9">
                    <i class="fa fa-plus fa-2x m-t-5" @click="addReq"></i>
                    <i class="fa fa-minus fa-2x m-t-5 m-l-5" @click="removeReq"></i>
                </div>
                <div class="row m-b-15" v-for="(req, j) in data.requirements" :key="j">
                    <div class="col-md-10">
                        <input class="form-control" v-model="data.requirements[j]" placeholder="Course Requirements">
              </div>
                    </div>
                </div>
                <div class="form-group">
                    <label for="result">Course Result</label>
                    <div class="col-md-2 offset-md-11 col-4 offset-9">
                        <i class="fa fa-plus fa-2x m-t-5" @click="addResult"></i>
                        <i class="fa fa-minus fa-2x m-t-5 m-l-5" @click="removeResult"></i>
                    </div>
                    <div class="row m-b-15" v-for="(result, i) in data.result" :key="i">
                        <div class="col-md-10">
                            <input class="form-control" v-model="data.result[i]" placeholder="Course Result">
              </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="tags">Tags</label>
                        <input-tag type="text" class="form-control" id="tags" :class="{'is-invalid':isError('tags')}" :tags.sync="data.tags" placeholder="Tags" addTagOnBlur :addTagOnKeys="[13,188,9,32]" />
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
            errors: [],
            data: [],
            categories: [],
            category_id: '',
            course_name: '',
            course_subtitle: '',
            course_description: '',
            course_price: '',
            requirements: [''],
            results: [''],
            tags: [''],
            errors: [],
            isSuccess: false,
            course_discounted : 0,
            course_limit : ''
        };
    },
    mounted() {
        axios.get(`/admin/api/category/data`).then((res) => {
            if (res.status === 200) {
                this.categories = res.data.data;
            }
        });
        var self = this;
        var groupColumn = 3;
        $(function () {
            self.table = $("#course-table").DataTable({
                responsive: true,
                autoWidth: false,
                processing: true,
                serverSide: true,
                ajax: `/admin/api/course/data`,
                order: [[groupColumn, "desc"]],
                columnDefs: [
                    { "visible": false, "targets": groupColumn }
                ],
                rowCallback: function (row, data, index) {
                    if (data["deleted_at"] != null) {
                        $(row).addClass("danger");
                    }
                },
                columns: [
                    { data: "id", name: "id" },
                    { data: "fullname", name: "fullname" },
                    {                        data: "course_name",
                        render: (data, type, row, meta) => {
                            return `<a href="/admin/course/video">${data}</a>`

                        }                    },
                    { data: "category_name", name: "category_name" },
                    { data: "course_subtitle", name: "course_subtitle" },
                    {
                        data: "student_count",
                        render: (data, type, row, meta) => {
                            return self.numberWithCommas(data)+'/'+row['course_limit'];
                        }
                    },
                    {
                        data: "course_price",
                        render: (data, type, row, meta) => {
                            return self.numberWithCommas(data);
                        }
                    },
                    {
                        data: null,
                        render: (data, type, row, meta) => {
                            return `<ul>
                                <li><a href="/admin/course/unit">หลักสูตร</a></li>`+
                                (row["type"] == 'live' ? `<li><a href="/admin/course/live" style="white-space: nowrap;">ตารางสอน</a></li>` : ``)
                                + `</ul>`
                        },
                        searchable: false,
                        sortable: false
                    },
                    {
                        data: null,
                        render: (data, type, row, meta) => {
                            return (
                                `
                          <div class="actions" data-id='` +
                                JSON.stringify(row) +
                                `'>
                            <a href="/product-detail" target="_blank"><i class="far fa-eye"></i></a>
                            <i class="fa fa-edit new-user-edit"></i>
                          ` +
                                (row["deleted_at"] == null
                                    ? '<i class="fa fa-trash-alt"></i>'
                                    : '<i class="fa fa-undo"></i>') +
                                `
                          </div>`
                            );
                        },
                        searchable: false,
                        sortable: false
                    }
                ],
                drawCallback: function (settings) {
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

                    var api = this.api();
                    var rows = api.rows({ page: 'current' }).nodes();
                    var last = null;

                    api.column(3, { page: 'current' }).data().each(function (group, i) {
                        if (last !== group) {
                            $(rows).eq(i).before(
                                '<tr class="group"><td colspan="7">หมวดหมู่ ' + group + '</td></tr>'
                            );

                            last = group;
                        }
                    });
                }
            });
            $('#course-table tbody').on('click', 'tr.group', function () {
                var currentOrder = self.table.order()[0];
                if (currentOrder[0] === groupColumn && currentOrder[1] === 'asc') {
                    self.table.order([groupColumn, 'desc']).draw();
                }
                else {
                    self.table.order([groupColumn, 'asc']).draw();
                }
            });
        });
    },
    methods: {
        deleteData(evt) {
            if (evt != undefined) evt.preventDefault();
            axios
                .post(`/admin/api/course` + "/" + this.data.id, {
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
            formData.append('category_id', this.data.category_id);
            formData.append('course_name', this.data.course_name);
            formData.append('course_subtitle', this.data.course_subtitle);
            formData.append('course_description', this.data.course_description);
            formData.append('course_price', this.data.course_price);
            formData.append('requirements', JSON.stringify(this.data.requirements));
            formData.append('results', JSON.stringify(this.data.results));
            formData.append('tags', JSON.stringify(this.data.tags));
            formData.append('course_discounted', this.data.course_discounted);
            formData.append('course_limit', this.data.course_limit);

            axios
                .post(`/admin/api/course` + "/" + this.data.id, formData)
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
        isError(field) {
            return this.errors[field] != undefined;
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
        }
    }
};
</script>

<style>
</style>
