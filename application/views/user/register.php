<?php if (isset($error) && !empty($error)): ?>
<div class ="alert alert-danger"><?php echo $error; ?></div>
<?php endif; ?>
<h1 class="text-center">Регистрация</h1>
<form method="POST" action="/user/register/">
	<div class="form-group">
		<label for="loginEmail">Email</label>
		<input type="email" class="form-control" name="email" id="loginEmail" placeholder="Ваш Email" required>
		<span id="validEmail" class="text-danger"></span>
	</div>
	<div class="form-group">
		<label for="loginLogin">Логин</label>
		<input type="text" class="form-control" name="login" id="loginLogin" placeholder="Ваш логин" required>
		<span id="validLogin" class="text-danger"></span>
	</div>
	<div class="form-group">
		<label for="loginPassword">Пароль</label>
		<input type="password" class="form-control" name="password" id="loginPassword" placeholder="Ваш пароль" required>
		<span id="validPassword" class="text-danger"></span>
	</div>
	<div class="form-group">
		<label for="loginRePassword">Повторите пароль</label>
		<input type="password" class="form-control" name="repassword" id="loginRePassword" placeholder="Снова пароль" required>
		<span id="validRePassword" class="text-danger"></span>
	</div>
	<button type="submit" class="btn btn-default">Регистрация</button>
</form>
<br>
<div class="alert alert-info" id="register-info">
	Регистрация нового пользователя
</div>