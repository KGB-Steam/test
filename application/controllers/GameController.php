<?php

class GameController extends Controller {

	function actionIndex() {
		if (!User::auth()) {
			header('Location: /user/login/');
		} else {
			$game = new Game;
			$model = $game->get_all_questions();
			$this->render('index', array('model' => $model));
		}
	}

	function actionPlay() {
		$id = App::gi()->uri->id;

		$game = new Game;

		if ($id > 0) {
			if ($game->verifyQuestion($id)) {
				$model = $game->get_question_by_id($id);
			} else {
				header('Location: /game/');
			}
		} else {
			header('Location: /game/');
		}
		
		$this->render('play', array('model' => $model));
	}

	function actionAnswer() {
		$game = new Game;

		if (isset($_POST['answer']) && !empty($_POST['answer'])) {
			$answer = Functions::Encode($_POST['answer']);
			$answer_id = Functions::Encode($_POST['answer_id']);

			$model = $game->verifyAnswer($answer_id, $answer);

			print $model;
		}
	}
}