<?php

class IndexController extends Controller {

	function actionIndex() {
		$this->render('index',array('model'=>$model));
	}
}