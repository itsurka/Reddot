<?php

class OptionValueController extends Controller
{
	/**
	 * @var string the default layout for the views. Defaults to '//layouts/column2', meaning
	 * using two-column layout. See 'protected/views/layouts/column2.php'.
	 */
	public $layout='//layouts/column2';

	/**
	 * Specifies the access control rules.
	 * This method is used by the 'accessControl' filter.
	 * @return array access control rules
	 */
	public function accessRules()
	{
            return array(
                array('allow',  // allow all users to perform 'index' and 'view' actions
                        'actions'=>array('index','admin','create','update','view'),
                        'roles'=>array("administrator","locale_administrator"),
                ),
                array('deny',
                    'actions'=>array('index','admin','create','update','view'),
                )
            );
	}

	/**
	 * Displays a particular model.
	 * @param integer $id the ID of the model to be displayed
	 */
	public function actionView($id)
	{
		$this->render('view',array(
			'model'=>$this->loadModel($id),
		));
	}

	/**
	 * Creates a new model.
	 * If creation is successful, the browser will be redirected to the 'view' page.
	 */
	public function actionCreate()
	{
            $model=new OptionValue;

            // Uncomment the following line if AJAX validation is needed
            // $this->performAjaxValidation($model);

            if(isset($_POST['OptionValue']))
            {
                    $model->attributes=$_POST['OptionValue'];
                    if($model->save())
                            $this->redirect(array('index'));
            }

            $this->render('create',array(
                    'model'=>$model,
            ));
	}
        //TODO: перенести в фильтры
        /**
         *проверка прав на редактирование/удаление опций для локального админа
         * @param type $model
         * @return boolean 
         */
        private function checkPermissions($model)
        {
            if ((Yii::app()->user->role==User::ROLE_LOCALE_ADMIN
                    &&
                $model->town->id_towns==Yii::app()->user->getTownId())
                    ||
                Yii::app()->user->role==User::ROLE_ADMIN)
                return true;
            return false;
        }
        
	/**
	 * Updates a particular model.
	 * If update is successful, the browser will be redirected to the 'view' page.
	 * @param integer $id the ID of the model to be updated
	 */
	public function actionUpdate($id)
	{
            $model=$this->loadModel($id);
            
            if (!$this->checkPermissions($model))
                throw new CHttpException(403,"У вас нет прав на редактирование");

            // Uncomment the following line if AJAX validation is needed
            // $this->performAjaxValidation($model);

            if(isset($_POST['OptionValue']))
            {
                    $model->attributes=$_POST['OptionValue'];
                    if($model->save())
                            $this->redirect(array('index'));
            }

            $this->render('update',array(
                    'model'=>$model,
            ));
	}

	/**
	 * Deletes a particular model.
	 * If deletion is successful, the browser will be redirected to the 'admin' page.
	 * @param integer $id the ID of the model to be deleted
	 */
	public function actionDelete($id)
	{
            if (!$this->checkPermissions($this->loadModel($id)))
                throw new CHttpException(403,"У вас нет прав на редактирование");
            
            if(Yii::app()->request->isPostRequest)
            {
                    // we only allow deletion via POST request
                    $this->loadModel($id)->delete();

                    // if AJAX request (triggered by deletion via admin grid view), we should not redirect the browser
                    if(!isset($_GET['ajax']))
                            $this->redirect(isset($_POST['returnUrl']) ? $_POST['returnUrl'] : array('admin'));
            }
            else
                    throw new CHttpException(400,'Invalid request. Please do not repeat this request again.');
	}

        /**
         *проверяем - задавал ли локальный админ локальные настройки
         * @return boolean 
         */
        private function isLocalSettingsCreated()
        {
            if (Yii::app()->user->role != User::ROLE_LOCALE_ADMIN)
                return true;
            if (OptionValue::model()->findAll("towns_id=:towns_id",array(":towns_id"=>Yii::app()->user->getTownId())))
                return true;
            else
                return false;
        }
        
        /**
         *создаем дефолтные настройки для определенного города 
         */
        private function createDefaultOptionValues()
        {
            $options = Option::model()->findAll("type='local'");
            foreach($options as $o)
            {
                $optionValue = new OptionValue;
                $optionValue->option_id = $o->id;
                $optionValue->value = $o->default_value;
                $optionValue->towns_id = Yii::app()->user->getTownId();
                $optionValue->save(false);
            }
        }
        
	/**
	 * Manages all models.
	 */
	public function actionIndex()
	{
            if (!$this->isLocalSettingsCreated())
            {
                $this->createDefaultOptionValues();
            }   
            $model=new OptionValue('search');
            $model->unsetAttributes();  // clear any default values
            if(isset($_GET['OptionValue']))
                    $model->attributes=$_GET['OptionValue'];

            $this->render('admin',array(
                    'model'=>$model,
            ));
	}

	/**
	 * Returns the data model based on the primary key given in the GET variable.
	 * If the data model is not found, an HTTP exception will be raised.
	 * @param integer the ID of the model to be loaded
	 */
	public function loadModel($id)
	{
		$model=OptionValue::model()->findByPk($id);
		if($model===null)
			throw new CHttpException(404,'The requested page does not exist.');
		return $model;
	}

	/**
	 * Performs the AJAX validation.
	 * @param CModel the model to be validated
	 */
	protected function performAjaxValidation($model)
	{
		if(isset($_POST['ajax']) && $_POST['ajax']==='option-value-form')
		{
			echo CActiveForm::validate($model);
			Yii::app()->end();
		}
	}
}
