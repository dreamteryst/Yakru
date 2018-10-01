<template>
    <section>
        <!-- begin breadcrumb -->
        <ol class="breadcrumb pull-right">
            <li class="breadcrumb-item"><a href="/">Home</a></li>
            <li class="breadcrumb-item active">Managed Order</li>
        </ol>
        <!-- end breadcrumb -->
        <!-- begin page-header -->
        <h1 class="page-header">Managed Order <small></small></h1>
        <!-- end page-header -->
        
        <!-- begin panel -->
        <div class="panel panel-inverse">
            <!-- begin panel-heading -->
            <div class="panel-heading">
                <div class="panel-heading-btn">
                    <a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-warning" data-click="panel-collapse"><i class="fa fa-minus"></i></a>
                </div>
                <h4 class="panel-title">List of Order</h4>
            </div>
            <!-- end panel-heading -->
            <!-- begin panel-body -->
            <div class="panel-body">
                <table id="data-table-default" class="table table-striped table-bordered">
                    <thead>
                        <tr>
                            <th width="1%" data-priority="1">ID</th>
                            <th class="text-nowrap">Order No</th>
                            <th class="text-nowrap">User</th>
                            <th class="text-nowrap">Course Name</th>
                            <th class="text-nowrap">Course Price</th>
                            <th width="1%" class="text-nowrap" data-priority="1">Actions</th>
                        </tr>
                    </thead>
                </table>
            </div>
        </div>
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
        ajax: `//${window.location.host}/api/order/data`,
        order: [[1, "desc"]],
        rowCallback: function(row, data, index) {
          if (data["deleted_at"] != null) {
            $(row).addClass("danger");
          }
        },
        columns: [
          { data: "id", name: "id" },
          { data: "order_no", name: "order_no" },
          { data: "fullname", name: "fullname" },
          { data: "course_name", name: "course_name" },
          { data: "course_price", name: "course_price" },
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
