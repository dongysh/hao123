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

							点卡管理

						</h3>

						<ul class="breadcrumb">

							<li>

								<i class="icon-home"></i>

								<a href="<?php echo ADMIN_PATH; ?>">首页</a> 

								<i class="icon-angle-right"></i>

							</li>

							<li><a href="#">点卡管理</a></li>

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

								<div class="caption"><i class="icon-globe"></i>点卡管理</div>

							</div>

							<div class="portlet-body form">

								<table class="table table-striped table-bordered table-hover" id="sample_2">

									<thead>

										<tr>

											<th style="width:8px;"><input type="checkbox" class="group-checkable" data-set="#sample_2 .checkboxes" /></th>

											<th>游戏名称</th>

											<th >运营商</th>

											<th class="hidden-480">点卡类型</th>

											<th class="hidden-480">点卡数量</th>

											<th >操作</th>

										</tr>

									</thead>

									<tbody>

										<?php if($gamelist):  ?>
										<?php foreach($gamelist as $key=>$val): ?>			
										<tr class="odd gradeX">

											<td><input type="checkbox" class="checkboxes" value="<?php echo $val['game_id']; ?>" /></td>

											<td><a href="<?=ADMIN_PATH?>/game/detail/<?=$val['game_id']?>"><?php echo $val["title"]; ?></td>

											<td><?php echo $val["operator"]; ?></td>

											<td><?php echo $val["group"]; ?></td>

											<td><?php echo $val["count"]; ?></td>

											<td>
												<a href="<?php echo ADMIN_PATH; ?>/card/listcards?game=<?=$val['game_id']?>&card=<?=$val['card_group']?>">
													<button class="btn">点卡列表</button>
												</a>
												<a href="<?php echo ADMIN_PATH; ?>/card/import?game=<?=$val['game_id']?>&card=<?=$val['card_group']?>">
													<button class="btn">导入点卡</button>
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

</body>

<!-- END BODY -->

</html>