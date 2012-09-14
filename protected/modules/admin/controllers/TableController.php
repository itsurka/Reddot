<?php

class TableController extends Controller {

    /**
     * @var string the default layout for the views. Defaults to '//layouts/column2', meaning
     * using two-column layout. See 'protected/views/layouts/column2.php'.
     */
    public $layout = '//layouts/column2';
    public $whiteTableList = array('city' => 'City', 'state' => 'State', 'users' => 'User');

    /**
     * @return array action filters
     */
    public function filters() {
        return array(
            'accessControl', // perform access control for CRUD operations
        );
    }

    /**
     * Specifies the access control rules.
     * This method is used by the 'accessControl' filter.
     * @return array access control rules
     */
    public function accessRules() {
        return array(
            array('allow', // allow all users to perform 'index' and 'view' actions
                'actions' => array('*'),
                'users' => array('*'),
            )
        );
    }

    //$table, $caption, $action, $id = ''
    public function actionTeditor($table, $caption, $action) {
        //die();
        //Check if table exist in the white list
        $validTableList = array_keys($this->whiteTableList);
        if (in_array($table, $validTableList)) {
            $class = $this->whiteTableList[$table];

            switch ($action) {
                case 'list': $this->actionIndex($class, $caption);
                    break;

                case 'create' : $this->actionCreate($class, $caption);
                    break;

                case 'view' : $this->actionView($class, $id);
                    break;

                case 'admin' : $this->actionAdmin($class, $caption);
                    break;

                case 'update' : $this->actionUpdate($class, $id, $caption);
                    break;

                case 'delete' : $this->actionDelete($class, $id);
                    break;
            }
        }
        else {
            print "Not a valid table";
            exit;
        }
    }

    /**
     * Displays a particular model.
     * @param integer $id the ID of the model to be displayed
     */
    public function actionView($class, $id) {
        $folder = strtolower($class);
        $this->render('//' . $folder . '/view', array(
            'model' => $this->loadModel($class, $id),
        ));
    }

    /**
     * Creates a new model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     */
    public function actionCreate($class, $caption) {
        $model = new $class;
        $folder = strtolower($class);
        // Uncomment the following line if AJAX validation is needed
        // $this->performAjaxValidation($model);

        if (isset($_POST[$class])) {
            $model->attributes = $_POST[$class];
            if ($model->save())
            //$this->redirect(array('//' . $folder . '/view', 'id' => $model->id));
                $this->redirect($this->createUrl("table/teditor&table=" . $folder . "&caption=" . $caption . "&action=view&id=" . $model->id));
        }

        $this->render('//' . $folder . '/create', array(
            'model' => $model,
        ));
    }

    /**
     * Updates a particular model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id the ID of the model to be updated
     */
    public function actionUpdate($class, $id, $caption) {
        $model = $this->loadModel($class, $id);

        $folder = strtolower($class);
        // Uncomment the following line if AJAX validation is needed
        // $this->performAjaxValidation($model);

        if (isset($_POST[$class])) {
            $model->attributes = $_POST[$class];
            if ($model->save()) {
                $this->redirect($this->createUrl("table/teditor&table=" . $folder . "&caption=" . $caption . "&action=view&id=" . $id));
            }
        }

        $this->render('//' . $folder . '/update', array(
            'model' => $model,
        ));
    }

    /**
     * Deletes a particular model.
     * If deletion is successful, the browser will be redirected to the 'admin' page.
     * @param integer $id the ID of the model to be deleted
     */
    public function actionDelete($class, $id) {
        $folder = strtolower($class);
        if (Yii::app()->request->isPostRequest) {
            // we only allow deletion via POST request
            $this->loadModel($class, $id)->delete();

            // if AJAX request (triggered by deletion via admin grid view), we should not redirect the browser
            if (!isset($_GET['ajax']))
                $this->redirect(isset($_POST['returnUrl']) ? $_POST['returnUrl'] : array('//' . $folder . '/admin'));
        }
        else
            throw new CHttpException(400, 'Invalid request. Please do not repeat this request again.');
    }

    /**
     * Lists all models.
     */
    public function actionIndex($class, $caption) {
        $this->actionAdmin($class, $caption);
    }

    /**
     * Manages all models.
     */
    public function actionAdmin($class, $caption) {
        $folder = strtolower($class);
        $model = new $class('search');
        $model->unsetAttributes();  // clear any default values
        if (isset($_GET[$class]))
            $model->attributes = $_GET[$class];

        $this->render('//' . $folder . '/admin', array(
            'model' => $model, 'caption' => $caption
        ));
    }

    /**
     * Returns the data model based on the primary key given in the GET variable.
     * If the data model is not found, an HTTP exception will be raised.
     * @param integer the ID of the model to be loaded
     */
    public function loadModel($class, $id) {
        $modelAr = call_user_func($class . '::model');
        $model = $modelAr->findByPk($id);
        if ($model === null)
            throw new CHttpException(404, 'The requested page does not exist.');
        return $model;
    }

    /**
     * Performs the AJAX validation.
     * @param CModel the model to be validated
     */
    protected function performAjaxValidation($model) {
        if (isset($_POST['ajax']) && $_POST['ajax'] === 'state-form') {
            echo CActiveForm::validate($model);
            Yii::app()->end();
        }
    }

}

