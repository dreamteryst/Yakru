<template>
    <section>
        <!-- begin breadcrumb -->
        <ol class="breadcrumb pull-right">
            <li class="breadcrumb-item"><a href="/">Home</a></li>
            <li class="breadcrumb-item active">การแจ้งชำระเงิน</li>
        </ol>
        <!-- end breadcrumb -->
        <!-- begin page-header -->
        <h1 class="page-header">การแจ้งชำระเงิน <small></small></h1>
        <!-- end page-header -->

        <!-- begin panel -->
        <div class="panel panel-inverse">
            <!-- begin panel-heading -->
            <div class="panel-heading">
                <div class="panel-heading-btn">
                    <a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-warning" data-click="panel-collapse"><i class="fa fa-minus"></i></a>
                </div>
                <h4 class="panel-title">รายการแจ้งชำระเงิน</h4>
            </div>
            <!-- end panel-heading -->
            <!-- begin panel-body -->
            <div class="panel-body">
                <table id="payment-table" class="table table-striped table-bordered">
                    <thead>
                        <tr>
                            <th width="1%" data-priority="1">ID</th>
                            <th class="text-nowrap">ชื่อ นามสกุล</th>
                            <th class="text-nowrap">เลขที่บัญชีโอนเข้า</th>
                            <th class="text-nowrap">ธนาคาร</th>
                            <th class="text-nowrap">จำนวน</th>
                            <th class="text-nowrap">เวลา</th>
                            <th class="text-nowrap">หลักฐาน</th>
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
    mounted() {
        var self = this;
        $(function () {
            self.table = $("#payment-table").DataTable({
                responsive: true,
                autoWidth: false,
                processing: true,
                serverSide: true,
                ajax: `/admin/api/payment/data`,
                order: [[0, "desc"]],
                rowCallback: function (row, data, index) {
                    if (data["deleted_at"] != null) {
                        $(row).addClass("danger");
                    }
                },
                columns: [
                    { data: "id", name: "id" },
                    { data: "fullname", name: "fullname" },
                    { data: "account_no", name: "account_no" },
                    { data: "bank_name", name: "bank_name" },
                    { data: "amount", name: "amount" },
                    { data: "transferred_at", name: "transferred_at" },
                    { 
                        data: "slip",
                        render: (data, type, row, meta) => {
                            return `<a href="${data}" target="_blank">View</a>`
                        }
                    },
                    {
                        data: null,
                        render: (data, type, row, meta) => {
                            return (
                                `
                          <div class="actions" data='` +
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
                ]
            });
        });
    }
}
</script>

<style>
</style>
