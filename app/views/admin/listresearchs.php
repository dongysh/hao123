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

							研发商列表

						</h3>

						<ul class="breadcrumb">

							<li>

								<i class="icon-home"></i>

								<a href="<?php echo ADMIN_PATH; ?>">首页</a> 

								<i class="icon-angle-right"></i>

							</li>

							<li><a href="#">研发商列表</a></li>

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

								<div class="caption"><i class="icon-globe"></i>研发商列表</div>

							</div>

							<div class="portlet-body">

								<div class="clearfix">

									<div class="btn-group">

										<button id="sample_editable_1_new" class="btn green" onclick="javascript:location.href='<?php echo ADMIN_PATH; ?>/research/addresearch'">

										添加 <i class="icon-plus"></i>

										</button>

									</div>

								</div>

								<table class="table table-striped table-bordered table-hover" id="sample_2">

									<thead>

										<tr>

											<th style="width:8px;"><input type="checkbox" class="group-checkable" data-set="#sample_2 .checkboxes" /></th>

											<th>研发商名称</th>

											<th >添加时间</th>

											<th >操作</th>

										</tr>

									</thead>

									<tbody>

										<?php if($researchlist):  ?>
										<?php foreach($researchlist as $key=>$val): ?>			
										<tr class="odd gradeX">

											<td><input type="checkbox" class="checkboxes" value="<?php echo $val['research_id']; ?>" /></td>

											<td><?php echo $val["research_name"]; ?></td>

											<td><?php echo $val["addtime"] ; ?></td>

											<td>
												<a href="<?php echo ADMIN_PATH; ?>/research/updateresearch/<?php echo $val["research_id"]; ?>">
													<button class="btn btn-primary">修改</button>
												</a>
												<a href="<?php echo ADMIN_PATH; ?>/research/deleteresearch/<?php echo $val["research_id"]; ?>?status=0" onclick="javascript:return confirm('您确定删除吗?');">
													<button class="btn btn-danger">删除</button>
												</a>
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