<?php if (isset($error) && !empty($error)): ?>
<div class ="alert alert-danger"><?php echo $error; ?></div>
<?php endif; ?>
<h1 class="text-center">Войти на сайт</h1>
<form method="POST" action="/user/login/">
	<div class="form-group">
		<label for="loginEmail">Email</label>
		<input type="email" class="form-control" name="email" id="loginEmail" placeholder="Ваш Email" required>
		<span id="validEmail" class="text-danger"></span>
	</div>
	<div class="form-group">
		<label for="loginPassword">Пароль</label>
		<input type="password" class="form-control" name="password" id="loginPassword" placeholder="Ваш пароль" required>
		<span id="validPassword" class="text-danger"></span>
	</div>
	<button type="submit" class="btn btn-default">Вход</button> <a href="/user/register/">Регистрация</a>
</form>