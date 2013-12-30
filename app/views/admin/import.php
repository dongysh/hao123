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

							批量导入点卡

						</h3>

						<ul class="breadcrumb">

							<li>

								<i class="icon-home"></i>

								<a href="<?php echo ADMIN_PATH; ?>">首页</a> 

								<i class="icon-angle-right"></i>

							</li>

							<li><a href="#">批量导入点卡</a></li>

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

						<!-- BEGIN VALIDATION STATES-->

						<div class="portlet box purple">

							<div class="portlet-title">

								<div class="caption"><i class="icon-reorder"></i>批量导入点卡</div>

							</div>

							<div class="portlet-body form">

								<!-- BEGIN FORM-->

								<form id="import_card_form" method="post" action="<?=ADMIN_PATH?>/card/import" class="form-horizontal" enctype="multipart/form-data">

									<div class="alert alert-error hide">

										<button class="close" data-dismiss="alert"></button>

										您的填写有误，请检查

									</div>

									<div class="alert alert-success hide">

										<button class="close" data-dismiss="alert"></button>

										您的填写无误!

									</div>

									<div class="control-group">

										<label class="control-label">游戏名<span class="required">*</span></label>

										<div class="controls">

											<input type="text" name="title" data-required="1" readonly class="span6 m-wrap" value="<?=$gameInfo['title']; ?>"/>

										</div>

									</div>

									<div class="control-group">

										<label class="control-label">点卡类型<span class="required">*</span></label>

										<div class="controls" readonly>

											<input type="text" name="card_group" data-required="1" readonly class="span6 m-wrap" value="<?=$gameInfo['card_group']; ?>" readonly />

										</div>

									</div>

									<div class="control-group">

										<label class="control-label">请选择CSV文件</label>

										<div class="controls">

											<input type="file" name="csvfile">

										</div>

									</div>

									<input type="hidden" name="game_id" value="<?php echo $_GET['game']; ?>"/>

									<input type="hidden" name="card_group" value="<?php echo $_GET['card']; ?>"/>

									<input type="hidden" name="action" value="importAction"/>

									<div class="form-actions">

										<button type="submit" class="btn purple">导入CSV</button>

										<button type="button" class="btn" onclick="javascript:history.go(-1);">返回</button>

									</div>

								</form>

								<!-- END FORM-->

							</div>

						</div>

						<!-- END VALIDATION STATES-->

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

	<!-- END FOOTER -->

	<!-- BEGIN JAVASCRIPTS(Load javascripts at bottom, this will reduce page load time) -->

	<?php 
   	  $this->load->view(ADMIN_DIR.'/_js.php');
  	?>

	<!-- END JAVASCRIPTS -->

<script type="text/javascript">  var _gaq = _gaq || [];  _gaq.push(['_setAccount', 'UA-37564768-1']);  _gaq.push(['_setDomainName', 'keenthemes.com']);  _gaq.push(['_setAllowLinker', true]);  _gaq.push(['_trackPageview']);  (function() {    var ga = document.createElement('script'); ga.type = 'text/javascript'; ga.async = true;    ga.src = ('https:' == document.location.protocol ? 'https://' : 'http://') + 'stats.g.doubleclick.net/dc.js';    var s = document.getElementsByTagName('script')[0]; s.parentNode.insertBefore(ga, s);  })();</script></body>

<!-- END BODY -->
