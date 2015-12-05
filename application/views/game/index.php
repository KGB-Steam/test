<?php
$html = '';

for ($i = 1; $i <= count($model['questions']); $i++) {
	if($model['current'] > $i) {
		$html .= '<button class="btn-question pass">' . $i . '</button>';
	} elseif ($model['current'] == $i) {
		$html .= '<a href="/game/play/' . $model['current'] . '/"><button class="btn-question current">' . $i . '</button></a>';
	} elseif ($model['current'] < $i) {
		$html .= '<button class="btn-question not">' . $i . '</button>';
	}
}

print $html;