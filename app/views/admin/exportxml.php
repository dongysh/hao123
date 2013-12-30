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

							导出XML

						</h3>

						<ul class="breadcrumb">

							<li>

								<i class="icon-home"></i>

								<a href="<?php echo ADMIN_PATH; ?>">首页</a> 

								<i class="icon-angle-right"></i>

							</li>

							<li><a href="#">导出XML</a></li>

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

								<div class="caption"><i class="icon-reorder"></i>导出XML</div>

							</div>

							<div class="portlet-body form">

								<!-- BEGIN FORM-->

								<form id="exportxml_form" class="form-horizontal" method="post" action="<?=ADMIN_PATH?>/game/exportxml">

									<div class="alert alert-error hide">

										<button class="close" data-dismiss="alert"></button>

										您的填写有误，请检查

									</div>

									<div class="alert alert-success hide">

										<button class="close" data-dismiss="alert"></button>

										您的填写无误!

									</div>

									<div class="control-group">

										<label class="control-label">游戏运营商<span class="required">*</span></label>

										<div class="controls">

											<select class="span6 m-wrap" name="operator">

												<option value="">请游戏运营商</option>

													<?php foreach ($operatorlist as $k=>$v):?>

														<option value="<?php echo $v['operator_id']; ?>" > <?php echo $v['operator_name']; ?> </option>

													<?php endforeach;?>

											</select>

										</div>

									</div>

									<div class="control-group">

										<label class="control-label">游戏开发商<span class="required">*</span></label>

										<div class="controls">

											<select class="span6 m-wrap" name="research">

												<option value="">请游戏开发商</option>

													<?php foreach ($researchlist as $k=>$v):?>

														<option value="<?php echo $v['research_id']; ?>" > <?php echo $v['research_name']; ?> </option>

													<?php endforeach;?>

											</select>

										</div>

									</div>

									<input type="hidden" name="action" value="exportAction"/>

									<div class="form-actions">

										<button type="submit" class="btn purple">点击导出</button>

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

	  	$(document).ready(function(){

	  		var form1 = $('#exportxml_form');
            var error1 = $('.alert-error', form1);
            var success1 = $('.alert-success', form1);

			form1.validate({
                errorElement: 'span', //default input error message container
                errorClass: 'help-inline', // default input error message class
                focusInvalid: false, // do not focus the last invalid input
                ignore: "",
                rules: {
                    operator: {
                    	required: true
                    },
                    research: {
                    	required: true
                    }
                },

	            messages: {
	                operator: {
                    	required: "请选择游戏运营商"
                    },
                    research: {
                    	required: "请选择游戏开发商"
                    }
	            },

                invalidHandler: function (event, validator) { //display error alert on form submit              
                    success1.hide();
                    error1.show();
                },

                highlight: function (element) { // hightlight error inputs
                    $(element)
                        .closest('.help-inline').removeClass('ok'); // display OK icon
                    $(element)
                        .closest('.control-group').removeClass('success').addClass('error'); // set error class to the control group
                },

                unhighlight: function (element) { // revert the change dony by hightlight
                    $(element)
                        .closest('.control-group').removeClass('error'); // set error class to the control group
                },

                success: function (label) {
                    label
                        .addClass('valid').addClass('help-inline ok') // mark the current input as valid and display OK icon
                    .closest('.control-group').removeClass('error').addClass('success'); // set success class to the control group
                }
            });
		});

  	</script>

</body>

<!-- END BODY -->
