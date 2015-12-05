<?php

class UserController extends Controller {

	function actionIndex() {
		if (!User::auth()) {
			header('Location: /user/login/');
		} else {
			$this->render('index', array('model'=>$model));
		}
	}

	function actionAvatar() {
		if (!User::auth()) {
			header('Location: /user/login/');
		} else {
			$this->layout = 'simple';
			$this->render('avatar');
		}
	}

	function actionLogin() {
		$error = '';

		if (User::auth()) {
			header('Location: /user/');
		} else {
			if (!isset($_POST['email'])) {
				$this->render('login');
			} else {
				$email = trim($_POST['email']);
				$pass = trim($_POST['password']);

				if (!empty($pass) && !empty($email)) {
					$user = new User;
					
					$res = $user->user_login($email, $pass);

					if ($res === 'OK') {
						header('Location: /user/');
					} else {
						$error = $res;
						$this->render('login', array('error' => $error));
					}
				} else {
					$error = 'Все поля необходимы для заполнения!';
					$this->render('login', array('error' => $error));
				}
			}
		}
	}

	function actionRegister() {
		$error = '';
		if (User::auth()) {
			header('Location: /user/');
		} else {
			if (isset($_POST['login'])) {
				$login = $_POST['login'];
				$email = $_POST['email'];
				$pass = $_POST['password'];
				$repass = $_POST['repassword'];

				if ((isset($login) && !empty($login)) &&
					(isset($email) && !empty($email)) &&
					(isset($pass) && !empty($pass)) &&
					(isset($repass) && !empty($repass))) {
					if ($pass === $repass) {
						$user = new User;
						$res = $user->user_register(array('login' => $login, 'email' => $email, 'pass' => $pass));

						if ($res == 'OK') {
							header('Location: /user/');
						} else {
							$this->render('register', array('error' => $res));
						}
					} else {
						$error = 'Пароли не совпадают';
						$this->render('register', array('error'=>$error));
					}
				} else {
					$error = 'Все поля необходимы для заполнения!';
					$this->render('register', array('error' => $error));
				}
			} else {
				$this->render('register');
			}
		}
	}

	function actionLogout() {
		User::logout();
		header('Location: /');
	}
}