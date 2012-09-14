<?php

class ProfileController extends Controller
{
	public $layout='column2';
	public $items;
	public $form;
	private $request_uri;
	private $id;

	/**
	 * @var CActiveRecord the currently loaded data model instance.
	 */
	private $_model;

	/**
	 * @return array action filters
	 */
	public function filters()
	{
		return array(
			'accessControl', // perform access control for CRUD operations
		);
	}

	/**
	 * Specifies the access control rules.
	 * This method is used by the 'accessControl' filter.
	 * @return array access control rules
	 */
	public function accessRules()
	{
		return array(
			array('allow', // allow authenticated users to access all actions
				'users'=>array('@'),
			),
			array('deny',  // deny all users
				'users'=>array('*'),
			),
		);
	}

	/**
	 * Lists all models.
	 */
	public function actionIndex()
	{

			$this->items = Yii::app()->db->createCommand()
             ->select('*')
             ->from( 'users' )
             ->where('id=:id',array(':id'=>Yii::app()->user->getId()))
             ->query()
             ->read();

		$this->render('index');
	}

	public function actionEdit()
	{
		$form = new User();
		$form_n = new User();
		$f_n = $form_n->findByPk(Yii::app()->user->getId());
		if(isset($_POST['User']))
		{
			$f_n->setScenario('edit');
			$f_n->attributes=$_POST['User'];
			if($f_n->save())
				$this->redirect(array('/profile/index/'));
		}

		$this->render('edit',array(
			'form'=>$form,
			'form_n'=>$f_n,
		));
	}

}
