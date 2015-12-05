<!DOCTYPE html>
<html lang="ru">
<head>
	<meta charset="<?=app::gi()->config->encode?>">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<meta name="description" content="">
	<meta name="author" content="">
	<title><?=app::gi()->config->sitename?></title>
	<link rel="icon" href="/assets/images/favicon.ico">
</head>
<body onkeyup="hotkey(event)">

    <div class="blog-masthead">
      <div class="container">
        <nav class="blog-nav">
            <a class="blog-nav-item <?=app::gi()->uri->controller=='index' ? 'active' :''?>" href="/">Главная</a>
            <?php if (User::auth()): ?>
                <a class="blog-nav-item <?=app::gi()->uri->controller=='page' ? 'active' :''?>" href="/game/">Играть</a>
                <a class="blog-nav-item <?=app::gi()->uri->controller=='feedback' ? 'active' :''?>" href="/questions/">Вопросы</a>
                <a class="blog-nav-item <?=app::gi()->uri->controller=='user' ? 'active' :''?>" href="/user/"><?=$_SESSION['login']?></a>
            <?php else: ?>
                <a class="blog-nav-item <?=app::gi()->uri->controller=='user' ? 'active' :''?>" href="/user/login/">Вход</a>
            <?php endif; ?>
        </nav>
      </div>
    </div>

    <div class="container">
		  <? include dirname(__FILE__).'/layouts/'.$this->layout.'.php';?>
    </div><!-- /.container -->
    <footer class="blog-footer">

    </footer>
	<?
	$this->addStyleSheet('/assets/css/blog.css','body');
	?>
  </body>
</html>
