<template>
    <section>
		<!-- begin breadcrumb -->
		<ol class="breadcrumb pull-right">
			<li class="breadcrumb-item"><a href="javascript:;">Home</a></li>
			<li class="breadcrumb-item active"><a href="javascript:;">Dashboard</a></li>
		</ol>
		<!-- end breadcrumb -->

		<!-- begin page-header -->
		<h1 class="page-header">ภาพรวมของระบบ</h1>
		<!-- end page-header -->

		<!-- begin row -->
		<div class="row">
			<!-- begin col-3 -->
			<div class="col-lg-3 col-md-6">
				<div class="widget widget-stats bg-gradient-green">
					<div class="stats-icon stats-icon-lg"><i class="fa fa-globe fa-fw"></i></div>
					<div class="stats-content">
						<div class="stats-title">ยอดผู้เข้าชมวคอร์สวันนี้</div>
						<div class="stats-number">7,842,900</div>
						<div class="stats-progress progress">
							<div class="progress-bar" style="width: 70.1%;"></div>
						</div>
					</div>
				</div>
			</div>
			<!-- end col-3 -->
			<!-- begin col-3 -->
			<div class="col-lg-3 col-md-6">
				<div class="widget widget-stats bg-gradient-blue">
					<div class="stats-icon stats-icon-lg"><i class="fa fa-archive fa-fw"></i></div>
					<div class="stats-content">
						<div class="stats-title">คอร์สทั้งหมด</div>
						<div class="stats-number">180,200</div>
						<div class="stats-progress progress">
							<div class="progress-bar" style="width: 40.5%;"></div>
						</div>
					</div>
				</div>
			</div>
			<!-- end col-3 -->
			<!-- begin col-3 -->
			<div class="col-lg-3 col-md-6">
				<div class="widget widget-stats bg-gradient-purple">
					<div class="stats-icon stats-icon-lg"><i class="fa fa-dollar-sign fa-fw"></i></div>
					<div class="stats-content">
						<div class="stats-title">ยอดขายคอร์ส (บาท)</div>
						<div class="stats-number">38,900</div>
						<div class="stats-progress progress">
							<div class="progress-bar" style="width: 76.3%;"></div>
						</div>
					</div>
				</div>
			</div>
			<!-- end col-3 -->
			<!-- begin col-3 -->
			<div class="col-lg-3 col-md-6">
				<div class="widget widget-stats bg-gradient-black">
					<div class="stats-icon stats-icon-lg"><i class="fa fa-comment-alt fa-fw"></i></div>
					<div class="stats-content">
						<div class="stats-title">ความคิดเห็นทั้งหมด</div>
						<div class="stats-number">3,988</div>
						<div class="stats-progress progress">
							<div class="progress-bar" style="width: 54.9%;"></div>
						</div>
					</div>
				</div>
			</div>
			<!-- end col-3 -->
		</div>
		<!-- end row -->
		
		<!-- begin row -->
		<div class="row">
			<!-- begin col-8 -->
			<div class="col-lg-8">
				<div class="widget-chart with-sidebar bg-black">
					<div class="widget-chart-content">
						<h4 class="chart-title">
							การวิเคราห์ผู้เข้าชม
							<small>Where do our visitors come from</small>
						</h4>
						<div id="visitors-line-chart" class="widget-chart-full-width nvd3-inverse-mode" style="height: 260px;"></div>
					</div>
					<div class="widget-chart-sidebar bg-black-darker">
						<div class="chart-number">
							1,225,729
							<small>Total visitors</small>
						</div>
						<div id="visitors-donut-chart" class="nvd3-inverse-mode p-t-10" style="height: 180px"></div>
						<ul class="chart-legend f-s-11">
							<li><i class="fa fa-circle fa-fw text-primary f-s-9 m-r-5 t-minus-1"></i> 34.0% <span>New Visitors</span></li>
							<li><i class="fa fa-circle fa-fw text-success f-s-9 m-r-5 t-minus-1"></i> 56.0% <span>Return Visitors</span></li>
						</ul>
					</div>
				</div>
			</div>
			<!-- end col-8 -->
			<!-- begin col-4 -->
			<div class="col-lg-4">
				<!-- begin panel -->
				<div class="panel panel-inverse" data-sortable-id="index-3">
					<div class="panel-heading">
						<h4 class="panel-title">Today's Schedule</h4>
					</div>
					<div id="schedule-calendar" class="bootstrap-calendar"></div>
					<div class="list-group">
						<a href="javascript:;" class="list-group-item d-flex justify-content-between align-items-center text-ellipsis">
							Sales Reporting
							<span class="badge f-w-500 bg-gradient-green f-s-10">9:00 am</span>
						</a> 
						<a href="javascript:;" class="list-group-item d-flex justify-content-between align-items-center text-ellipsis">
							Have a meeting with sales team
							<span class="badge f-w-500 bg-gradient-blue f-s-10">2:45 pm</span>
						</a>
					</div>
				</div>
				<!-- end panel -->
			</div>
			<!-- end col-4 -->
		</div>
		<!-- end row -->
    </section>
</template>

<script>
export default {
	mounted() {
		$(function() {
			DashboardV2.init();
		})
	}
}
</script>

<style>

</style>
