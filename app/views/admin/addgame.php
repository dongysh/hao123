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

							添加游戏

						</h3>

						<ul class="breadcrumb">

							<li>

								<i class="icon-home"></i>

								<a href="<?php echo ADMIN_PATH; ?>">首页</a> 

								<i class="icon-angle-right"></i>

							</li>

							<li><a href="#">添加游戏</a></li>

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

								<div class="caption"><i class="icon-reorder"></i>添加游戏</div>

							</div>

							<div class="portlet-body form">

								<!-- BEGIN FORM-->

								<form action="<?=ADMIN_PATH?>/game/addgame" id="add_game_form" class="form-horizontal" method="post" enctype="multipart/form-data">

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

											<input type="text" name="title" data-required="1" class="span6 m-wrap"/>

										</div>

									</div>

									<div class="control-group">

										<label class="control-label">展示图片<span class="required">*</span></label>

										<div class="controls">

											<input type="file" name="img" data-required="1" class="span6 m-wrap"/>

										</div>

									</div>

									<div class="control-group">

										<label class="control-label">游戏官方网址<span class="required">*</span></label>

										<div class="controls">

											<input type="text" name="website" data-required="1" class="span6 m-wrap"/>

										</div>

									</div>

									<div class="control-group">

										<label class="control-label">游戏类型<span class="required">*</span></label>

										<div class="controls">

											<select name="type">

												<option value="">请选择游戏类型</option>

												<?php foreach($consts["type"] as $k=>$v): ?>

												<option value="<?php echo ($k+1);?>"><?php echo $v; ?></option>

												<?php endforeach; ?>

											</select>

										</div>

									</div>

									<div class="control-group">

										<label class="control-label">游戏画面类型<span class="required">*</span></label>

										<div class="controls">

											<select name="painting">

												<option value="">请选择游戏画面类型</option>

												<?php foreach($consts["painting"] as $k=>$v): ?>

												<option value="<?php echo ($k+1);?>"><?php echo $v; ?></option>

												<?php endforeach; ?>

											</select>

										</div>

									</div>

									<div class="control-group">

										<label class="control-label">游戏风格<span class="required">*</span></label>

										<div class="controls">

											<select name="style">

												<option value="">请选择游戏风格</option>

												<?php foreach($consts["style"] as $k=>$v): ?>

												<option value="<?php echo ($k+1);?>"><?php echo $v; ?></option>

												<?php endforeach; ?>

											</select>

										</div>

									</div>

									<div class="control-group">

										<label class="control-label">游戏当前状态<span class="required">*</span></label>

										<div class="controls">

											<select name="status">

												<option value="">请选择游戏当前状态</option>

												<?php foreach($consts["status"] as $k=>$v): ?>

												<option value="<?php echo ($k+1);?>"><?php echo $v; ?></option>

												<?php endforeach; ?>

											</select>

										</div>

									</div>

									<div class="control-group">

										<label class="control-label">游戏分类<span class="required">*</span></label>

										<div class="controls">

											<select name="ctg">

												<option value="">请选择游戏分类</option>

												<?php foreach($consts["ctg"] as $k=>$v): ?>

												<option value="<?php echo ($k+1);?>"><?php echo $v; ?></option>

												<?php endforeach; ?>

											</select>

										</div>

									</div>

									<div class="control-group">

										<label class="control-label">游戏运营商<span class="required">*</span></label>

										<div class="controls">

											<select name="operator">

												<option value="">请选择游戏运营商</option>

												<?php foreach($operator as $v): ?>

												<option value="<?php echo $v['operator_id'];?>"><?php echo $v['operator_name']; ?></option>

												<?php endforeach; ?>

											</select>

										</div>

									</div>

									<div class="control-group">

										<label class="control-label">游戏开发商<span class="required">*</span></label>

										<div class="controls">

											<select name="research">

												<?php if($_SESSION['operator_id'] == 0): ?>

												<option value="">请选择游戏开发商</option>

												<?php endif; ?>

												<?php foreach($research as $v): ?>

												<option value="<?php echo $v['research_id'];?>"><?php echo $v['research_name']; ?></option>

												<?php endforeach; ?>

											</select>

										</div>

									</div>

									<div class="control-group">

										<label class="control-label">游戏来源<span class="required">*</span></label>

										<div class="controls">

											<select name="origin">

												<option value="">请选择游戏来源</option>

												<?php foreach($consts["origin"] as $k=>$v): ?>

												<option value="<?php echo ($k+1);?>"><?php echo $v; ?></option>

												<?php endforeach; ?>

											</select>

										</div>

									</div>

									<div class="control-group">

										<label class="control-label">当前点卡类型<span class="required">*</span></label>

										<div class="controls">

											<select name="card_group">

												<option value="">请选择当前点卡类型</option>

												<?php foreach($consts["card_group"] as $k=>$v): ?>

												<option value="<?php echo ($k+1);?>"><?php echo $v; ?></option>

												<?php endforeach; ?>

											</select>

										</div>

									</div>

									<div class="control-group">

										<label class="control-label">点卡发放起始时间</label>

										<div class="controls">

											<input class="m-wrap m-ctrl-medium date-picker" readonly name="starttime" size="16" type="text" value="" />

										</div>

									</div>

									<div class="control-group">

										<label class="control-label">点卡发放截止时间</label>

										<div class="controls">

											<input class="m-wrap m-ctrl-medium date-picker" readonly name="endtime" size="16" type="text" value="" />

										</div>

									</div>

									<div class="control-group">

										<label class="control-label">描述信息</label>

										<div class="controls">

											<textarea class="span6 m-wrap" name="desc" rows="3"></textarea>

										</div>

									</div>

									<input type="hidden" name="action" value="addAction"/>

									<div class="form-actions">

										<button type="submit" class="btn purple">提交</button>

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
		    $( ".date-picker" ).datepicker();
		    $( "#anim" ).change(function() {
		      $( "#datepicker" ).datepicker( "option", "showAnim", $( this ).val() );
		    });

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

  	<script type="text/javascript">

		$(document).ready(function(){

			var form1 = $('#add_game_form');
            var error1 = $('.alert-error', form1);
            var success1 = $('.alert-success', form1);

			form1.validate({
                errorElement: 'span', //default input error message container
                errorClass: 'help-inline', // default input error message class
                focusInvalid: false, // do not focus the last invalid input
                ignore: "",
                rules: {
                    title: {
                        required: true
                    },
                    website: {
                    	required: true
                    },
                    img: {
                    	required: true
                    },
                    type: {
                    	required: true
                    },
                    painting: {
                    	required: true
                    },
                    style: {
                    	required: true
                    },
                    status: {
                    	required: true
                    },
                    ctg: {
                    	required: true
                    },
                    operator: {
                    	required: true
                    },
                    research: {
                    	required: true
                    },
                    origin: {
                    	required: true
                    },
                    card_group: {
                    	required: true
                    }
                },

	            messages: {
	                title: {
	                    required: "请输入游戏名称"
	                },
                    website: {
                    	required: "请输入游戏官网网址"
                    },
                    img: {
                    	required: "请上传游戏展示图片"
                    },
                    type: {
                    	required: "请选择游戏类型"
                    },
                    painting: {
                    	required: "请选择游戏画面类型"
                    },
                    style: {
                    	required: "请选择游戏风格"
                    },
                    status: {
                    	required: "请选择游戏当前状态"
                    },
                    ctg: {
                    	required: "请选择游戏分类"
                    },
                    operator: {
                    	required: "请选择游戏运营商"
                    },
                    research: {
                    	required: "请选择游戏开发商"
                    },
                    origin: {
                    	required: "请选择游戏来源"
                    },
                    card_group: {
                    	required: "请选择当前点卡类型"
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
                },

     //            submitHandler: function (form) {
     //                success1.show();
     //                error1.hide();
     //                var data = $("#add_game_form").formToArray();
					// $.ajax({
					// 	type: "POST",
					// 	url:  "<?=ADMIN_PATH?>/game/addgame",
					// 	contentType: "false",
					// 	data: data,
					// 	dataType: 'json',
					// 	success: function(msg){
					// 		if(msg.status)
					// 		{
					// 			window.location.href = "<?=ADMIN_PATH?>/game/listgames";
					// 		}
					// 		else
					// 		{
					// 			alert(msg.message);
					// 		}
					// 	}
					// });
     //            }
            });
		});

	</script>

<script type="text/javascript">  var _gaq = _gaq || [];  _gaq.push(['_setAccount', 'UA-37564768-1']);  _gaq.push(['_setDomainName', 'keenthemes.com']);  _gaq.push(['_setAllowLinker', true]);  _gaq.push(['_trackPageview']);  (function() {    var ga = document.createElement('script'); ga.type = 'text/javascript'; ga.async = true;    ga.src = ('https:' == document.location.protocol ? 'https://' : 'http://') + 'stats.g.doubleclick.net/dc.js';    var s = document.getElementsByTagName('script')[0]; s.parentNode.insertBefore(ga, s);  })();</script></body>

<!-- END BODY -->

</html>