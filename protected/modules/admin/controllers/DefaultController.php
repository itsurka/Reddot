<?php

class DefaultController extends Controller
{
	public function actionIndex()
	{
            //Yii::app()->theme = '\\layouts\classic';
		$this->redirect('admin/user/index');
	}
}