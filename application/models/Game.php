<?php

class Game extends Model {

	public function get_question() {
		$user_id = $_SESSION['id'];

		$query = $this->db->query("SELECT * FROM game_questions LEFT JOIN (
  														SELECT question_id
  														FROM game_answers_user
  														WHERE user_id = $user_id
													  ) query1
  											ON game_questions.id = query1.question_id
									WHERE query1.question_id IS NULL")->rows();
		return $query[rand(0, count($query) - 1)];
	}

	public function get_all_questions() {
		$user_id = $_SESSION['id'];

		$current = $this->db->item('#__users_game', "user_id=$user_id", 'current_question');
		$questions = $this->db->orderBy('id')->items('#__questions', '1', 'id');

		return array('current' => $current['current_question'], 'questions' => $questions);
	}

	public function get_question_by_id($id) {
		$user_id = $_SESSION['id'];

		$question = $this->db->item('#__questions', "id=$id");

		$answer = $this->db->item('#__user_answers', "user_id=$user_id AND done=0", 'id, question_id, answers');

		if (count($answer) == 0) {
			$this->db->insert('#__user_answers', "user_id=$user_id, done=0, question_id=$id");
			$answer = array('id' => $this->db->id(),
							'question_id' => $id,
							'answers' => '');
		}

		return array('question' => $question, 'answer' => $answer);
	}

	public function verifyAnswer($id, $answer) {
		/*
		** Возвращаемые значения
		**	2 - слово уже есть
		**	1 - неверное слово
		**  3 - верное слово
		*/
		$user_id = $_SESSION['id'];
		$yy = $answer;
		$answer = mb_strtolower($answer, 'utf8');

		$question = $this->db->item('#__questions', "id=$id", 'answers');
		$q_answers = unserialize($question['answers']);
		
		if (in_array($answer, $q_answers)) {
			$ans = $this->db->item('#__user_answers', "question_id=$id AND done=0 AND user_id=$user_id AND done=0 AND question_id=$id", 'answers');
			$answers = unserialize($ans['answers']);

			if (isset($answers[0])) {
				if (in_array($answer, $answers)) {
					return '2';
				}
			}

			$answers[] = $answer;
			$answer = serialize($answers);

			if (count($answers) == count($q_answers)) {
				$this->db->insert('#__answers_user', "question_id=$id, user_id=$user_id");
				$this->db->update('#__user_answers', "answers='$answer', done=1", "user_id=$user_id AND done=0 AND question_id=$id");
				$query = $this->db->query("SELECT * FROM game_questions LEFT JOIN (
  														SELECT question_id
  														FROM game_answers_user
  														WHERE user_id = $user_id
													  ) query1
  											ON game_questions.id = query1.question_id
									WHERE query1.question_id IS NULL")->rows();
				$q = $query[rand(0, count($query) - 1)];
				$i = $q['id'];
				$this->db->insert('#__user_answers', "question_id=$i, user_id=$user_id, done=0");

				return '3';
			} else {
				$this->db->update('#__user_answers', "answers='$answer'", "user_id=$user_id AND done=0 AND question_id=$id");

				$arr = $this->get_question_by_id($id);
				$ser = unserialize($arr['answer']['answers']);
				$ser['count'] = count($q_answers);

				return json_encode($ser, JSON_UNESCAPED_UNICODE);
			}
		} else {
			return '1';
		}
	}

	public static function verifyQuestion($id) {
		$user_id = $_SESSION['id'];

		$answer = App::gi()->db->items('#__user_answers', "user_id=$user_id");

		if (count($answer) > 0) {
			foreach ($answer as $key => $value) {
				if ($value['done'] == '0' && $value['question_id'] == $id) {
					return true;
				} elseif($value['done'] == '1' && $value['question_id'] == $id) {
					return false;
				}
			}
			return $answer;
		} else {
			return true;
		}
	}
}