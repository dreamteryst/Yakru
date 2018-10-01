<template>
    <section>
        <!-- begin breadcrumb -->
        <ol class="breadcrumb pull-right">
            <li class="breadcrumb-item"><a href="/">Home</a></li>
            <li class="breadcrumb-item active">Managed Category</li>
        </ol>
        <!-- end breadcrumb -->
        <!-- begin page-header -->
        <h1 class="page-header">Managed Category <small></small></h1>
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
                <table id="data-table-default" class="table table-striped table-bordered">
                    <thead>
                        <tr>
                            <th width="1%" data-priority="1">ID</th>
                            <th width="20%" class="text-nowrap">Name</th>
                            <th class="text-nowrap">Description</th>
                            <th width="1%" class="text-nowrap" data-priority="1">Actions</th>
                        </tr>
                    </thead>
                </table>
            </div>
        </div>
        <!-- Modal Component -->
        <b-modal id="modal1" v-model="modalDelete" size="lg" @ok="deleteData" ok-title="Delete" ok-variant="danger" :title="'Delete '+data.category_name" @hidden="onHidden">
            <div class="alert alert-danger fade show" v-if="isError('delete')">
                <span class="close" data-dismiss="alert">×</span>
                <strong>Error!</strong>
                {{ errors.delete }}
            </div>
            <div class="table-responsive">
                <table class="table table-bordered">
                    <tr>
                        <th width="1%">ID</th>
                        <th class="text-nowrap">Name</th>
                        <th class="text-nowrap">Description</th>
                    </tr>
                    <tr>
                        <td>{{ data.id }}</td>
                        <td>{{ data.category_name }}</td>
                        <td>{{ data.category_description }}</td>
                    </tr>
                </table>
            </div>
        </b-modal>
        
        <b-modal id="modalNewEdit" v-model="modalEdit" size="lg" @ok="editData" ok-title="Edit" ok-variant="success" :title="'Edit '+data.category_name" @hidden="onHidden">
            <div class="alert alert-danger fade show" v-if="isError('message')">
                <span class="close" data-dismiss="alert">×</span>
                <strong>Error!</strong>
                {{ errors.message }}
            </div>
            <div class="form-group">
                <label for="categoryName">Category Name</label>
                <input type="text" class="form-control" :class="{'is-invalid':isError('category_name')}" id="categoryName" v-model="data.category_name" placeholder="Category Name">
                <div class="invalid-feedback" v-if="isError('category_name')">
                    {{ errors.category_name[0] }}
                </div>
            </div>
            <div class="form-group">
                <label for="description">Description</label>
                <textarea class="form-control" id="description" :class="{'is-invalid':isError('category_description')}" v-model="data.category_description" placeholder="Description" rows="10"></textarea>
                <div class="invalid-feedback" v-if="isError('category_description')">
                    {{ errors.category_description[0] }}
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
      errors: [],
      data: []
    };
  },
  mounted() {
    var self = this;
    $(function() {
      self.table = $("#data-table-default").DataTable({
        responsive: true,
        autoWidth: false,
        processing: true,
        serverSide: true,
        ajax: `//${window.location.host}/api/category/data`,
        order: [[1, "desc"]],
        rowCallback: function(row, data, index) {
          if (data["deleted_at"] != null) {
            $(row).addClass("danger");
          }
        },
        columns: [
          { data: "id", name: "id" },
          { data: "category_name", name: "category_name" },
          { data: "category_description", name: "category_description" },
          {
            data: null,
            render: (data, type, row, meta) => {
              return (
                `
                          <div class="actions" data='` +
                JSON.stringify(row) +
                `'>
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
        drawCallback: function(settings) {
          $(".fa-edit").on("click", function() {
            self.data = JSON.parse(
              $(this)
                .closest("div")
                .attr("data")
            );
            self.modalEdit = true;
          });

          $(".fa-trash-alt").on("click", function() {
            self.data = JSON.parse(
              $(this)
                .closest("div")
                .attr("data")
            );
            self.modalDelete = true;
          });
          $(".fa-undo").on("click", function() {
            self.data = JSON.parse(
              $(this)
                .closest("div")
                .attr("data")
            );
            self.deleteData();
          });
        }
      });
    });
  },
  methods: {
    deleteData(evt) {
      if (evt != undefined) evt.preventDefault();
      axios
        .post(`//${window.location.host}/api/category` + "/" + this.data.id, {
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
      formData.append("category_name", this.data.category_name);
      formData.append("category_description", this.data.category_description);

      axios
        .post(`//${window.location.host}/api/category` + "/" + this.data.id, formData)
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
    }
  }
};
</script>

<style>
</style>
