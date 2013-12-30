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

							更新管理员

						</h3>

						<ul class="breadcrumb">

							<li>

								<i class="icon-home"></i>

								<a href="<?php echo ADMIN_PATH; ?>">首页</a> 

								<i class="icon-angle-right"></i>

							</li>

							<li><a href="#">更新管理员</a></li>

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

								<div class="caption"><i class="icon-reorder"></i>更新管理员</div>

							</div>

							<div class="portlet-body form">

								<!-- BEGIN FORM-->

								<form action="" id="update_user_form" class="form-horizontal">

									<div class="alert alert-error hide">

										<button class="close" data-dismiss="alert"></button>

										您的填写有误，请检查

									</div>

									<div class="alert alert-success hide">

										<button class="close" data-dismiss="alert"></button>

										您的填写无误!

									</div>

									<div class="control-group">

										<label class="control-label">管理员名<span class="required">*</span></label>

										<div class="controls">

											<input type="text" name="username" data-required="1" class="span6 m-wrap" value="<?=$adminInfo['admin_name']; ?>" />

										</div>

									</div>

									<div class="control-group">

										<label class="control-label">游戏平台<span class="required">*</span></label>

										<div class="controls">

											<select class="span6 m-wrap" name="operator">

												<option value="">请选择游戏平台</option>

													<?php foreach ($operatorlist as $k=>$v):?>

														<option value="<?php echo $v['operator_id']; ?>" 
															<?php if($v['operator_id']==$adminInfo['operator_id']) echo "selected"; ?> > <?php echo $v['operator_name']; ?> </option>

													<?php endforeach;?>

											</select>

										</div>

									</div>

									<div class="control-group">

										<label class="control-label">游戏名称<span class="required">*</span></label>

										<div class="controls">

											<select class="span6 m-wrap" name="game">

												<option value="">请选择游戏</option>

												<?php if(isset($gamelist)): ?>

													<?php foreach ($gamelist as $k=>$v):?>

														<option value="<?php echo $v['game_id']; ?>" <?php if($v['game_id']==$adminInfo['game_id']) echo "selected"; ?>  ><?php echo $v['title']; ?></option>

													<?php endforeach;?>

												<?php endif; ?>

											</select>

										</div>

									</div>

									<input type="hidden" name="action" value="updateAction"/>

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

		$(document).ready(function(){

			$('select[name=operator]').change(function(){

				var op = $(this).val();

				$('select[name=game]').html("<option value=''>请选择游戏</option>");

		    	$.ajax({
					type: "POST",
					url:  "<?=ADMIN_PATH?>/game/get_game_by_operator",
					data: {
						operator : op
					},
					dataType: 'json',
					success: function(result){
						var games = '';
						for(var v in result){
				        	var games = games + "<option value='" + result[v].game_id +"'>" + result[v].title+"</option>";
				        }
						$('select[name=game]').append(games);
					}
				});
		    });

			var form1 = $('#update_user_form');
            var error1 = $('.alert-error', form1);
            var success1 = $('.alert-success', form1);

			form1.validate({
                errorElement: 'span', //default input error message container
                errorClass: 'help-inline', // default input error message class
                focusInvalid: false, // do not focus the last invalid input
                ignore: "",
                rules: {
                    username: {
                        minlength: 4,
                        maxlength: 20,
                        required: true,
                        //remote: "/admin/user/checkUname"
                    },
                    operator: {
                        required: true
                    },
                    game_id: {
                    	require: true
                    }
                },

	            messages: {
	                username: {
	                    required: "请输入管理员名"
	                },
	                operator: {
                        required: "请选择游戏平台"
                    },
                    game_id: {
                    	require: "请选择游戏"
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

                submitHandler: function (form) {
                    success1.show();
                    error1.hide();
                    var data = $("#update_user_form").formToArray();
					$.ajax({
						type: "POST",
						url:  "<?=ADMIN_PATH?>/admin/updateAdmin/<?=$adminInfo['admin_id']?>",
						data: data,
						dataType: 'json',
						success: function(msg){
							if(msg.status)
							{
								window.location.href = msg.linkto;
							}
							else
							{
								alert(msg.message);
							}
						}
					});
                }
            });
		});

	</script>

<script type="text/javascript">  var _gaq = _gaq || [];  _gaq.push(['_setAccount', 'UA-37564768-1']);  _gaq.push(['_setDomainName', 'keenthemes.com']);  _gaq.push(['_setAllowLinker', true]);  _gaq.push(['_trackPageview']);  (function() {    var ga = document.createElement('script'); ga.type = 'text/javascript'; ga.async = true;    ga.src = ('https:' == document.location.protocol ? 'https://' : 'http://') + 'stats.g.doubleclick.net/dc.js';    var s = document.getElementsByTagName('script')[0]; s.parentNode.insertBefore(ga, s);  })();</script></body>

<!-- END BODY -->

</html>