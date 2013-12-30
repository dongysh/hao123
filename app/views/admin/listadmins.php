<!DOCTYPE html>

<html lang="en" class="no-js">

<!-- BEGIN HEAD -->

<head>

	<meta charset="utf-8" />

	<title><?=WEB_TITLE;?></title>

	<meta content="width=device-width, initial-scale=1.0" name="viewport" />

	<meta content="" name="description" />

	<meta content="" name="author" />

	<!-- BEGIN STYLES -->

	<?php 
   	  $this->load->view(ADMIN_DIR.'/_css.php');
  	?>

  	<!-- END STYLES -->

	<link rel="shortcut icon" href="<?=STYLE_PATH?>/image/favicon.ico" />

</head>

<!-- END HEAD -->

<!-- BEGIN BODY -->

<body class="page-header-fixed">

	<!-- BEGIN HEADER -->

	<?php 
   	  $this->load->view(ADMIN_DIR.'/_header.php');
  	?>

	<!-- END HEADER -->

	<!-- BEGIN CONTAINER -->

	<div class="page-container">

		<!-- BEGIN SIDEBAR -->

		<?php 
	   	  $this->load->view(ADMIN_DIR.'/_sidebar.php');
	  	?>

		<!-- END SIDEBAR -->

		<!-- BEGIN PAGE -->

		<div class="page-content">

			<!-- BEGIN PAGE CONTAINER-->

			<div class="container-fluid">

				<!-- BEGIN PAGE HEADER-->

				<div class="row-fluid">

					<div class="span12">  

						<!-- BEGIN PAGE TITLE & BREADCRUMB-->

						<h3 class="page-title">

							管理员列表

						</h3>

						<ul class="breadcrumb">

							<li>

								<i class="icon-home"></i>

								<a href="<?php echo ADMIN_PATH; ?>">首页</a> 

								<i class="icon-angle-right"></i>

							</li>

							<li><a href="#">管理员列表</a></li>

							<li class="pull-right no-text-shadow">

								<div id="dashboard-report-range" class="dashboard-date-range tooltips no-tooltip-on-touch-device responsive" data-tablet="" data-desktop="tooltips" data-placement="top" data-original-title="Change dashboard date range">

									<i class="icon-calendar"></i>

									<span></span>

									<i class="icon-angle-down"></i>

								</div>

							</li>

						</ul>

						<!-- END PAGE TITLE & BREADCRUMB-->

					</div>

				</div>

				<!-- END PAGE HEADER-->

				<!-- BEGIN PAGE CONTENT-->

				<div class="row-fluid">

					<div class="span12">

						<!-- BEGIN EXAMPLE TABLE PORTLET-->

						<div class="portlet box light-grey">

							<div class="portlet-title">

								<div class="caption"><i class="icon-globe"></i>管理员列表</div>

							</div>

							<div class="portlet-body">

								<div class="clearfix">

									<div class="btn-group">

										<button id="sample_editable_1_new" class="btn green" onclick="javascript:location.href='<?php echo ADMIN_PATH; ?>/admin/addAdmin'">

										添加 <i class="icon-plus"></i>

										</button>

									</div>

								</div>

								<table class="table table-striped table-bordered table-hover" id="sample_2">

									<thead>

										<tr>

											<th style="width:8px;"><input type="checkbox" class="group-checkable" data-set="#sample_2 .checkboxes" /></th>

											<th>管理员名</th>

											<th class="hidden-480">权限</th>

											<th class="hidden-480">状态</th>

											<th >最后登录时间</th>

											<th >操作</th>

										</tr>

									</thead>

									<tbody>

										<?php if($adminlist):  ?>
										<?php foreach($adminlist as $key=>$val): ?>			
										<tr class="odd gradeX">

											<td><input type="checkbox" class="checkboxes" value="<?php echo $val['admin_id']; ?>" /></td>

											<td><?php echo $val["admin_name"]; ?></td>

											<td>

												<?php if($val['operator_id'] == 0): ?>

												超级管理员

												<?php elseif(($val['operator_id'] != 0) && ($val['game_id'] == 0) ): ?>

												平台管理员

												<?php elseif(($val['operator_id'] != 0) && ($val['game_id'] != 0) ): ?>

												游戏管理员

												<?php endif; ?>

											</td>

											<td><?php if($val["status"]==1): ?>开启<?php else: ?>关闭<?php endif; ?></td>

											<td><?php echo $val["last_login_time"]; ?></td>

											<td>
												<a href="<?php echo ADMIN_PATH; ?>/admin/updateAdmin/<?php echo $val["admin_id"]; ?>">
													<button class="btn btn-primary">修改</button>
												</a>

												<?php if($val["admin_id"] != $_SESSION["admin_id"] ): ?>
												<?php if($val["status"]==1): ?>
												<a href="<?php echo ADMIN_PATH; ?>/admin/updateAdminStatus/<?php echo $val["admin_id"]; ?>?status=0" onclick="javascript:return confirm('您确定删除吗?');">
													<button class="btn btn-danger">删除</button>
												</a>
												<?php else: ?>
												<a href="<?php echo ADMIN_PATH; ?>/admin/updateAdminStatus/<?php echo $val["admin_id"]; ?>?status=1" onclick="javascript:return confirm('您确定启用吗?');">
													<button class="btn btn-info">启用</button>
												</a>
												<?php endif; ?>
												<?php endif; ?>
											</td>
											
										</tr>
										<?php endforeach; ?>
										<?php else:  ?>
										<?php endif; ?>

									</tbody>

								</table>

							</div>

						</div>

						<!-- END EXAMPLE TABLE PORTLET-->

					</div>

				</div>

				<!-- END PAGE CONTAINER-->

			</div>			    

		</div>

		<!-- END PAGE -->

	</div>

	<!-- END CONTAINER -->

	<!-- BEGIN FOOTER -->

	<?php 
   	  $this->load->view(ADMIN_DIR.'/_footer.php');
  	?>

	<?php 
   	  $this->load->view(ADMIN_DIR.'/_js.php');
  	?>

	<script>

		jQuery(document).ready(function() {   

		   TableManaged.init();

		});

	</script>

<script type="text/javascript">  var _gaq = _gaq || [];  _gaq.push(['_setAccount', 'UA-37564768-1']);  _gaq.push(['_setDomainName', 'keenthemes.com']);  _gaq.push(['_setAllowLinker', true]);  _gaq.push(['_trackPageview']);  (function() {    var ga = document.createElement('script'); ga.type = 'text/javascript'; ga.async = true;    ga.src = ('https:' == document.location.protocol ? 'https://' : 'http://') + 'stats.g.doubleclick.net/dc.js';    var s = document.getElementsByTagName('script')[0]; s.parentNode.insertBefore(ga, s);  })();</script></body>

<!-- END BODY -->

</html>