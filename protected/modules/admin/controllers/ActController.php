<?php

class ActController extends Controller {

    /**
     * @var string the default layout for the views. Defaults to '//layouts/column2', meaning
     * using two-column layout. See 'protected/views/layouts/column2.php'.
     */
    public $layout = '//layouts/column2';

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
                'actions' => array('index', 'admin', 'create', 'update', 'view'),
                'roles' => array("administrator", "locale_administrator"),
            ),
            array('deny',
                'actions' => array('index', 'admin', 'create', 'update', 'view'),
            )
        );
    }

    /**
     * Displays a particular model.
     * @param integer $id the ID of the model to be displayed
     */
    public function actionView($id) {
        $this->render('view', array(
            'model' => $this->loadModel($id),
        ));
    }

    /**
     * Creates a new model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     */
    public function actionCreate() {
        $act = new Act;
        $coupons[] = new Coupon();
        $valid = array();

        if (isset($_POST['Act']) && isset($_POST['Coupon'])) {
            $act->attributes = $_POST['Act'];
            $act->photo_act = CUploadedFile::getInstance($act, 'photo_act');
            $valid[] = $act->validate();

            $i = 0;
            foreach ($_POST['Coupon'] as $coupon) {
                $coupons[$i] = new Coupon();
                $coupons[$i]->setAttributes($coupon);
                $valid[] = $coupons[$i]->validate();

                $i++;
            }

            if (!in_array(false, $valid)) {
                $act->save(false);
                $act->savePicture();

                foreach ($coupons as $coupon) {
                    $coupon->act_id = $act->id_act;
                    $coupon->save(false);
                }

                $this->redirect(array('index'));
            }
        }

        $this->render('create', array(
            'act' => $act,
            'coupons' => $coupons,
        ));
    }

    /**
     * Updates a particular model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id the ID of the model to be updated
     */
    public function actionUpdate($id) {
        $act = $this->loadModel($id);
        $coupons = $act->coupons;
        $valid = array();

        if (isset($_POST['Act']) && isset($_POST['Coupon'])) {
            if (empty($_POST['Act']['photo_act'])) {
                unset($_POST['Act']['photo_act']);
            }

            $act->attributes = $_POST['Act'];
            $photo = CUploadedFile::getInstance($act, 'photo_act');
            $act->photo_act = $photo ? $photo : $act->photo_act;
            $valid[] = $act->validate();
            $coupons = array();
            $availableIds = array();

            foreach ($_POST['Coupon'] as $id => $coupon) {
                if (is_integer($id)) {
                    $coupons[$id] = Coupon::model()->findByPk($id);
                    $availableIds[] = $id;
                } else {
                    $coupons[$id] = new Coupon();
                }

                $coupons[$id]->setAttributes($coupon);
                $valid[] = $coupons[$id]->validate();
            }

            // Удалить все купоны, id которыех нет в массиве
            $criteria = new CDbCriteria();
            $criteria->addNotInCondition('id', $availableIds);
            $criteria->addCondition('act_id = :act_id');
            $criteria->params = $criteria->params + array(
                ':act_id' => $act->id_act,
            );

            Coupon::model()->deleteAll($criteria);

            if (!in_array(false, $valid)) {
                if ($act->save(false)) {
                    if (!empty($act->delete_picture)) {
                        $act->deletePicture();
                    } else {
                        $act->savePicture();
                    }
                }

                foreach ($coupons as $coupon) {
                    $coupon->act_id = $act->id_act;
                    $coupon->save(false);
                }

                $this->redirect(array('index'));
            }
        }

        $this->render('update', array(
            'act' => $act,
            'coupons' => $coupons,
        ));
    }

    /**
     * Lists all models.
     */
    public function actionIndex() {
        $model = new Act('search');
        $model->unsetAttributes();  // clear any default values
        if (isset($_GET['Act']))
            $model->attributes = $_GET['Act'];

        $this->render('admin', array(
            'model' => $model,
        ));
    }

    /**
     * Returns the data model based on the primary key given in the GET variable.
     * If the data model is not found, an HTTP exception will be raised.
     * @param integer the ID of the model to be loaded
     */
    public function loadModel($id) {
        $model = Act::model()->findByPk($id);
        if ($model === null)
            throw new CHttpException(404, 'The requested page does not exist.');
        return $model;
    }

    /**
     * Performs the AJAX validation.
     * @param CModel the model to be validated
     */
    protected function performAjaxValidation($model) {
        if (isset($_POST['ajax']) && $_POST['ajax'] === 'act-form') {
            echo CActiveForm::validate($model);
            Yii::app()->end();
        }
    }

    public function actionClone($id) {
        $act = $this->loadModel($id);
        $cloneAct = new Act();
        $cloneAct->paid = $act->paid;
        $cloneAct->name_act = $act->name_act . '...(Копия)';
        $short_url = $act->short_url;
        if((strlen($short_url)+strlen('(Копия)')) > 32)
            $short_url = substr($short_url, 0, strlen($short_url)-strlen('(Копия)'));
        $short_url = substr($short_url, 0, strlen($short_url)-3);
        $cloneAct->short_url = $short_url . '...(Копия)';
        $cloneAct->seo_title = $act->seo_title;
        $cloneAct->seo_keywords = $act->seo_keywords;
        $cloneAct->seo_description = $act->seo_description;
        $cloneAct->url_name = $act->url_name;
        $cloneAct->photo_act = md5($act->photo_act);
        $cloneAct->clonePictures($act->photo_act, md5($act->photo_act));
        $cloneAct->short_text_act = $act->short_text_act;
        $cloneAct->terms = $act->terms;
        $cloneAct->id_org_act = $act->id_org_act;
        $cloneAct->id_themes_act = $act->id_themes_act;
        $cloneAct->id_tag_act = $act->id_tag_act;
        $cloneAct->price_old = $act->price_old;
        $cloneAct->price_new = $act->price_new;
        $cloneAct->price_new_description = $act->price_new_description;
        $cloneAct->coupon_count = $act->coupon_count;
        $cloneAct->coupon_purchased = 0;
        $cloneAct->coupon_need = $act->coupon_need;
        $cloneAct->is_bonus = $act->is_bonus;
        $cloneAct->date_start_act = $act->date_start_act;
        $cloneAct->date_end_act = $act->date_end_act;
        $cloneAct->date_end_coupon_act = $act->date_end_coupon_act;
        $cloneAct->full_text_act = $act->full_text_act;
        $cloneAct->id_town_act = $act->id_town_act;
        $cloneAct->save();
    }


    /**
     * Сменить заначение акции, активная или нет
     *
     * @param $id
     * @return void
     */
    public function actionChangeActivity($id) {
        $model = $this->loadModel($id);
        $model->is_active = $model->is_active ? 0 : 1;
        $model->save();
        Yii::app()->end();
    }
}
