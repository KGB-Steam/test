<?php

class PageController extends Controller {

  function actionRead($id='index') {
  	$exp = explode('.', $id);
    $this->render('read', array('id' => $exp[0]));
  }
}