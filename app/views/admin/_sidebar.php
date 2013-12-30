<!-- BEGIN SIDEBAR -->

<div class="page-sidebar nav-collapse collapse">

	<!-- BEGIN SIDEBAR MENU -->        

	<ul class="page-sidebar-menu">

		<li>

			<!-- BEGIN SIDEBAR TOGGLER BUTTON -->

			<div class="sidebar-toggler hidden-phone"></div>

			<!-- BEGIN SIDEBAR TOGGLER BUTTON -->

		</li>

		<li class="start <?php if(isset($sidebar_index)) echo $sidebar_index; ?> ">

			<a href="<?php echo ADMIN_PATH; ?>">

			<i class="icon-home"></i> 

			<span class="title">后台首页</span>

			<span class="<?php if(isset($sidebar_index)): ?>selected <?php else: ?>title <?php endif; ?>"></span>

			</a>

		</li>

		<?php if(($_SESSION['operator_id'] != 0) && ($_SESSION['game_id'] == 0) || $_SESSION['operator_id'] == 0 ): ?>
		
		<li class="<?php if(isset($sidebar_admin)) echo $sidebar_admin; ?>">

			<a class="active" href="<?php echo ADMIN_PATH; ?>/admin/listadmins">

			<i class="icon-user"></i> 

			<span class="title">管理员中心</span>

			<span class="<?php if(isset($sidebar_admin)): ?>selected <?php else: ?>title <?php endif; ?>"></span>

			</a>

		</li>

		<?php endif; ?>

		<li class="last <?php if(isset($sidebar_game)) echo $sidebar_game; ?>">

			<a class="active" href="javascript:void(0)">

			<i class="icon-gamepad"></i>  

			<span class="title">游戏管理</span>

			<span class="<?php if(isset($sidebar_game)): ?>selected open<?php else: ?>arrow <?php endif; ?>"></span>

			</a>

			<ul class="sub-menu">

				<?php if(($_SESSION['operator_id'] != 0) && ($_SESSION['game_id'] == 0) || $_SESSION['operator_id'] == 0 ): ?>

				<li class="<?php if(isset($sidebar_game_list)) echo $sidebar_game_list; ?>">

					<a class="active" href="<?php echo ADMIN_PATH; ?>/game/listgames">

					游戏列表

					</a>

				</li>

				<?php endif; ?>

				<?php if($_SESSION['operator_id'] == 0 ): ?>

				<li class="<?php if(isset($sidebar_game_operator)) echo $sidebar_game_operator; ?>">

					<a href="<?php echo ADMIN_PATH; ?>/operator/listoperators">

					运营商列表

					</a>

				</li>

				<li class="<?php if(isset($sidebar_game_research)) echo $sidebar_game_research; ?>">

					<a href="<?php echo ADMIN_PATH; ?>/research/listresearchs">

					研发商列表

					</a>

				</li>

				<?php endif; ?>

				<li class="<?php if(isset($sidebar_game_card)) echo $sidebar_game_card; ?>">

					<a href="<?php echo ADMIN_PATH; ?>/card/listgames">

					点卡管理

					</a>

				</li>

			</ul>

		</li>

	</ul>

	<!-- END SIDEBAR MENU -->

</div>

<!-- END SIDEBAR -->