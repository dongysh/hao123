<!-- BEGIN HEADER -->

<div class="header navbar navbar-inverse navbar-fixed-top">

	<!-- BEGIN TOP NAVIGATION BAR -->

	<div class="navbar-inner">

		<div class="container-fluid">

			<!-- BEGIN LOGO -->

			<a class="brand" href="<?=ADMIN_PATH?>">

			<img src="<?=STYLE_PATH?>/image/logo2.gif" alt="logo"/>

			</a>

			<!-- END LOGO -->

			<!-- BEGIN RESPONSIVE MENU TOGGLER -->

			<a href="javascript:;" class="btn-navbar collapsed" data-toggle="collapse" data-target=".nav-collapse">

			<img src="<?=STYLE_PATH?>/image/menu-toggler.png" alt="" />

			</a>          

			<!-- END RESPONSIVE MENU TOGGLER -->            

			<!-- BEGIN TOP NAVIGATION MENU -->              

			<ul class="nav pull-right">

				<!-- BEGIN USER LOGIN DROPDOWN -->

				<li class="dropdown user">

					<a href="#" class="dropdown-toggle" data-toggle="dropdown">

					<img alt="" src="<?=STYLE_PATH?>/image/avatar1_small.jpg" />

					<span class="username"><?php if(isset($_SESSION['admin_name'])) echo $_SESSION['admin_name']; ?></span>

					<i class="icon-angle-down"></i>

					</a>

					<ul class="dropdown-menu">

						<li><a href="<?php echo ADMIN_PATH; ?>/admin/info"><i class="icon-user"></i> 个人资料</a></li>

						<li><a href="<?php echo ADMIN_PATH; ?>/admin/changepwd"><i class="icon-calendar"></i> 修改密码</a></li>

						<li class="divider"></li>

						<li><a href="<?=ADMIN_PATH?>/main/logout" onclick="javascript:return confirm('您确定退出登录吗?');"><i class="icon-key"></i> 退出</a></li>

					</ul>

				</li>

				<!-- END USER LOGIN DROPDOWN -->

			</ul>

			<!-- END TOP NAVIGATION MENU --> 

		</div>

	</div>

	<!-- END TOP NAVIGATION BAR -->

</div>

<!-- END HEADER -->