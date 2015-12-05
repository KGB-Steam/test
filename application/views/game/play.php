<?php 

	$answers_ans = unserialize($model['answer']['answers']);
	$answers = unserialize($model['question']['answers']);

	echo '<div id="question-group"><div class="alert alert-info text-center">' . $model['question']['question'] . '</div>';

	if ((count($answers_ans) > 0) && (!empty($answers_ans))) {
		for ($i = 0; $i < count($answers); $i++) {
			if ($i < count($answers_ans)) {
				echo '<div class="alert alert-success button-answer">' . $answers_ans[$i] . '</div>';
			} else {
				echo '<div class="alert alert-danger button-answer">' . ($i + 1) . '</div>';
			}
		}
	} else {
		for ($i = 0; $i < count($answers); $i++) {
			echo '<div class="alert alert-danger button-answer">' . ($i + 1) . '</div>';
		}
	}
	echo '</div>';
?>
<div id="answer-group">
</div>
<div class="clearfix"></div>
<div id="key"></div>
<div id="letters-group">
	<div id="first-line">
		<div class="letter hvr-glow" onclick="addLetter(this)"><span>Й</span></div>
		<div class="letter hvr-glow" onclick="addLetter(this)"><span>Ц</span></div>
		<div class="letter hvr-glow" onclick="addLetter(this)"><span>У</span></div>
		<div class="letter hvr-glow" onclick="addLetter(this)"><span>К</span></div>
		<div class="letter hvr-glow" onclick="addLetter(this)"><span>Е</span></div>
		<div class="letter hvr-glow" onclick="addLetter(this)"><span>Н</span></div>
		<div class="letter hvr-glow" onclick="addLetter(this)"><span>Г</span></div>
		<div class="letter hvr-glow" onclick="addLetter(this)"><span>Ш</span></div>
		<div class="letter hvr-glow" onclick="addLetter(this)"><span>Щ</span></div>
		<div class="letter hvr-glow" onclick="addLetter(this)"><span>З</span></div>
		<div class="letter hvr-glow" onclick="addLetter(this)"><span>Х</span></div>
		<div class="letter hvr-glow" onclick="addLetter(this)"><span>Ъ</span></div>
	</div>
	<div id="second-line">
		<div class="letter hvr-glow" onclick="addLetter(this)"><span>Ф</span></div>
		<div class="letter hvr-glow" onclick="addLetter(this)"><span>Ы</span></div>
		<div class="letter hvr-glow" onclick="addLetter(this)"><span>В</span></div>
		<div class="letter hvr-glow" onclick="addLetter(this)"><span>А</span></div>
		<div class="letter hvr-glow" onclick="addLetter(this)"><span>П</span></div>
		<div class="letter hvr-glow" onclick="addLetter(this)"><span>Р</span></div>
		<div class="letter hvr-glow" onclick="addLetter(this)"><span>О</span></div>
		<div class="letter hvr-glow" onclick="addLetter(this)"><span>Л</span></div>
		<div class="letter hvr-glow" onclick="addLetter(this)"><span>Д</span></div>
		<div class="letter hvr-glow" onclick="addLetter(this)"><span>Ж</span></div>
		<div class="letter hvr-glow" onclick="addLetter(this)"><span>Э</span></div>
	</div>
	<div id="third-line">
		<div class="letter hvr-glow" onclick="addLetter(this)"><span>Я</span></div>
		<div class="letter hvr-glow" onclick="addLetter(this)"><span>Ч</span></div>
		<div class="letter hvr-glow" onclick="addLetter(this)"><span>С</span></div>
		<div class="letter hvr-glow" onclick="addLetter(this)"><span>М</span></div>
		<div class="letter hvr-glow" onclick="addLetter(this)"><span>И</span></div>
		<div class="letter hvr-glow" onclick="addLetter(this)"><span>Т</span></div>
		<div class="letter hvr-glow" onclick="addLetter(this)"><span>Ь</span></div>
		<div class="letter hvr-glow" onclick="addLetter(this)"><span>Б</span></div>
		<div class="letter hvr-glow" onclick="addLetter(this)"><span>Ю</span></div>
		<div class="letter hvr-glow" onclick="addLetter(this)"><span>Ё</span></div>
	</div>
	<div id="fourth-line">
		<div class="letter hvr-glow" onclick="addLetter(this)"><span>-</span></div>
		<div class="letter space hvr-glow" onclick="addLetter(this)"><span></span></div>
		<div class="letter hvr-glow" onclick="backspace()"><span>←</span></div>
	</div>
	<div id="fifth-line">
		<div class="letter enter hvr-glow" onclick="sendWord(<?=$model['question']['id']?>)"><span>Отправить</span></div>
	</div>
</div>
<div class="clearfix"></div><br>
<div id="desc" class="alert alert-warning">
	Ввод слов осуществляется с клавиатуры (раскладка значения не имеет), либо нажатием мыши по соответствующим кнопкам.<br>Удаление букв с клавиатуры осуществляется с помощью клавиши "Delete".
</div>