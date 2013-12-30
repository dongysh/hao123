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

							游戏详情

						</h3>

						<ul class="breadcrumb">

							<li>

								<i class="icon-home"></i>

								<a href="<?php echo ADMIN_PATH; ?>">首页</a> 

								<i class="icon-angle-right"></i>

							</li>

							<li><a href="#">游戏详情</a></li>

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

								<div class="caption"><i class="icon-reorder"></i>游戏详情</div>

							</div>

							<div class="portlet-body form">

								<!-- BEGIN FORM-->

								<form action="<?=ADMIN_PATH?>/game/updategame/<?=$gameInfo['game_id']?>" method="post" id="update_game_form" class="form-horizontal" enctype="multipart/form-data">

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

										<label class="control-label">展示图片</label>

										<div class="controls">

											<input type="button" name="openter" class="btn blue" value="查看图片">

											<div id="dialog" title="游戏展示图片">
											 	<img src="<?=$gameInfo['imgurl']?>">
											</div>

										</div>

									</div>

									<div class="control-group">

										<label class="control-label">游戏官方网址<span class="required">*</span></label>

										<div class="controls">

											<input type="text" name="website" data-required="1" readonly class="span6 m-wrap" value="<?=$gameInfo['website']; ?>" />

										</div>

									</div>

									<div class="control-group">

										<label class="control-label">游戏类型<span class="required">*</span></label>

										<div class="controls">

											<input type="text" name="type" data-required="1" readonly class="span6 m-wrap" value="<?=$gameInfo['type']; ?>" readonly />

										</div>

									</div>

									<div class="control-group">

										<label class="control-label">游戏画面类型<span class="required">*</span></label>

										<div class="controls">

											<input type="text" name="painting" data-required="1" readonly class="span6 m-wrap" value="<?=$gameInfo['painting']; ?>" readonly />

										</div>

									</div>

									<div class="control-group">

										<label class="control-label">游戏风格<span class="required">*</span></label>

										<div class="controls">

											<input type="text" name="style" data-required="1" readonly class="span6 m-wrap" value="<?=$gameInfo['style']; ?>" readonly />

										</div>

									</div>

									<div class="control-group">

										<label class="control-label">游戏当前状态<span class="required">*</span></label>

										<div class="controls">

											<input type="text" name="status" data-required="1" readonly class="span6 m-wrap" value="<?=$gameInfo['status']; ?>" readonly />

										</div>

									</div>

									<div class="control-group">

										<label class="control-label">游戏分类<span class="required">*</span></label>

										<div class="controls">

											<input type="text" name="ctg" data-required="1" readonly class="span6 m-wrap" value="<?=$gameInfo['ctg']; ?>" readonly />

										</div>

									</div>

									<div class="control-group">

										<label class="control-label">游戏运营商<span class="required">*</span></label>

										<div class="controls" readonly>

											<input type="text" name="operator" data-required="1" readonly class="span6 m-wrap" value="<?=$gameInfo['operator']; ?>" readonly />

										</div>

									</div>

									<div class="control-group">

										<label class="control-label">游戏开发商<span class="required">*</span></label>

										<div class="controls" readonly>

											<input type="text" name="research" data-required="1" readonly class="span6 m-wrap" value="<?=$gameInfo['research']; ?>" readonly />

										</div>

									</div>

									<div class="control-group">

										<label class="control-label">游戏来源<span class="required">*</span></label>

										<div class="controls">

											<input type="text" name="origin" data-required="1" readonly class="span6 m-wrap" value="<?=$gameInfo['origin']; ?>" readonly />

										</div>

									</div>

									<div class="control-group">

										<label class="control-label">当前点卡类型<span class="required">*</span></label>

										<div class="controls" readonly>

											<input type="text" name="card_group" data-required="1" readonly class="span6 m-wrap" value="<?=$gameInfo['card_group']; ?>" readonly />

										</div>

									</div>

									<div class="control-group">

										<label class="control-label">点卡发放起始时间</label>

										<div class="controls" readonly>

											<input class="m-wrap m-ctrl-medium date-picker" readonly name="starttime" size="16" type="text" value="<?=$gameInfo['card_start_time']; ?>" />

										</div>

									</div>

									<div class="control-group">

										<label class="control-label">点卡发放截止时间</label>

										<div class="controls">

											<input class="m-wrap m-ctrl-medium date-picker" readonly name="endtime" size="16" type="text" value="<?=$gameInfo['card_end_time']; ?>" />

										</div>

									</div>

									<div class="control-group">

										<label class="control-label">描述信息</label>

										<div class="controls">

											<textarea class="span6 m-wrap" readonly name="desc" rows="3"><?php echo $gameInfo['desc'] ?></textarea>

										</div>

									</div>

									<div class="form-actions">

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

	<?php 
   	  $this->load->view(ADMIN_DIR.'/_js.php');
  	?>  

  	<script type="text/javascript">

	  	$(function() {
		    

		    $( "#dialog" ).dialog({
		      autoOpen: false,
		      show: {
		        effect: "blind",
		        duration: 1000
		      },
		      hide: {
		        effect: "explode",
		        duration: 1000
		      }
		    });
		 
		    $("input[name=openter]" ).click(function() {
		      $( "#dialog" ).dialog( "open" );
		    });

		    $("input[name=img]").removeClass("span6").addClass("span3");
		});

  	</script>

</body>

<!-- END BODY -->

</html>