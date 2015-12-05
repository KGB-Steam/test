<div class="row" style="margin-top:20px;">
<div class="col-sm-7 blog-main" >
	<?=$content?>
</div><!-- /.blog-main -->
<div class="col-sm-4 col-sm-offset-1 blog-sidebar">
  <div class="sidebar-module sidebar-module-inset">
	<?php if (User::auth()): ?>
		<h3 class="text-center"><?=$_SESSION['login']?></h3>
		<div id="avatar">
			<?php
				$file = '/assets/images/users/' . $_SESSION['id'] . '/avatar.jpg';
				if (file_exists(USER_IMAGES . $_SESSION['id'] . '/avatar.jpg')) {
					$avatar = $file;
				} else {
					$avatar = '/assets/images/avatar.gif';
				}
			?>
			<img src="<?=$avatar?>" width="150px">
		</div>
	<?php endif; ?>
  </div>
  <div class="sidebar-module">
	<ol class="list-unstyled">
	  <li><a href="/user/logout/">Выход</a></li>
	</ol>
  </div>
</div><!-- /.blog-sidebar -->
</div><!-- /.row -->