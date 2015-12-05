<?php
class User extends Model{

	public function user_login($email, $pass) {
		$email = $this->db->real_string($email);
		$pass = $this->db->real_string($pass);

		$user = $this->db->item('#__users', "email='$email'");

		if (count($user) > 0) {
			if ($user['pass'] === crypt($pass, $user['pass'])) {
				$_SESSION['auth'] = 'true';
				$_SESSION['login'] = $user['login'];
				$_SESSION['email'] = $user['email'];
				$_SESSION['id'] = $user['id'];

				return 'OK';
			} else {
				return 'Неправильный пароль!';
			}
		} else {
			return 'Пользователь с таким Email не найден!';
		}
	}

	public function t() {
		return 'www';
	}

	public function user_register (array $data) {
		extract($data, EXTR_PREFIX_SAME, "arr");

		$ret = $this->db->item('#__users', "login='$login' OR email='$email'");

		if (count($ret) > 0) {
			return 'Пользователь с таким логином или Email уже существует!';
		} else {
			$login = $this->db->real_string($login);
			$email = $this->db->real_string($email);
			$pass = $this->db->real_string($pass);

			$pass = crypt($pass, Functions::blowfishSalt());

			$this->db->insert('#__users', "login='$login', email='$email', pass='$pass'");
			if ($this->db->errno() > 0) {
				return 'Ошибка при регистрации. Попробуйте позже.';
			} else {
				return "OK";
			}
		}
	}

	public static function auth() {
		if (isset($_SESSION['auth']) && $_SESSION['auth'] === 'true') {
			return true;
		}
		return false;
	}

	public static function logout() {
		session_destroy();
	}
}