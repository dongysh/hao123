<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<title>用户登录</title>
	<?php 
	  $this->load->view(ADMIN_DIR.'/_css.php');
	?>
</head>
<body>

<div class="container">
	<div class="container" style="margin-top:100px">
    	<h3><?php echo $message; ?></h3>
   		<a href="<?=$linkto?>"><button class="btn">确定</button></a>
   		<?php if($message=="文章添加成功"): ?>
   			<a href="<?=ADMIN_PATH?>/article/addArticle"><button class="btn">继续添加</button></a>
   		<?php endif; ?>
  </div>
</div>

</body>
</html>