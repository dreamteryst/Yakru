<template>
  <section>
    <!-- begin breadcrumb -->
    <ol class="breadcrumb pull-right">
      <li class="breadcrumb-item">
        <a href="/">หน้าแรก</a>
      </li>
      <li class="breadcrumb-item active">รายการเติมเงิน</li>
    </ol>
    <!-- end breadcrumb -->
    <!-- begin page-header -->
    <h1 class="page-header">รายการเติมเงิน
      <small></small>
    </h1>
    <!-- end page-header -->
    <!-- begin panel -->
    <div class="panel panel-inverse">
      <!-- begin panel-heading -->
      <div class="panel-heading">
        <div class="panel-heading-btn">
          <a
            href="javascript:;"
            class="btn btn-xs btn-icon btn-circle btn-warning"
            data-click="panel-collapse"
          >
            <i class="fa fa-minus"></i>
          </a>
        </div>
        <h4 class="panel-title">รายการเติมเงิน</h4>
      </div>
      <!-- end panel-heading -->
      <!-- begin panel-body -->
      <div class="panel-body">
        <DataTable id="table-topup-data" url="/admin/api/topup/data" :columns="columns" :disabledActions="true"/>
      </div>
    </div>
  </section>
</template>

<script>
export default {
    data() {
        return {
            columns: [
                {
                    data: "name",
                    name: "name",
                    text: 'ชื่อ'
                },
                {
                    data: "method",
                    name: "method",
                    text: 'ช่องทาง'
                }
                ,
                {
                    data: "amount",
                    name: "amount",
                    text: 'จำนวน'
                }
            ]
        };
    }
};
</script>

<style>
</style>
