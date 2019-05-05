<template>
  <section>
    <!-- begin breadcrumb -->
    <ol class="breadcrumb pull-right">
      <li class="breadcrumb-item">
        <a href="/">หน้าแรก</a>
      </li>
      <li class="breadcrumb-item active">จัดการแบบทดสอบ</li>
    </ol>
    <!-- end breadcrumb -->
    <!-- begin page-header -->
    <h1 class="page-header">
      จัดการแบบทดสอบ
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
        <h4 class="panel-title">รายการแบบทดสอบ</h4>
      </div>
      <!-- end panel-heading -->
      <!-- begin panel-body -->
      <div class="panel-body">
        <DataTable
          id="table-example-course"
          :url="`/admin/api/example/data/${this.$route.params.id}`"
          :columns="columns"
          newable
          @clickNew="newData"
        />
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
                    data: "course",
                    name: "course",
                    text: "คอร์ส"
                },
                {
                    data: "example_type",
                    name: "example_type",
                    text: "ประเภทแบบทดสอบ"
                }
            ]
        };
    },
    methods: {
        newData() {
            this.$router.push(`/admin/course/example/${this.$route.params.id}/add`)
        }
    }
};
</script>

<style>
</style>
