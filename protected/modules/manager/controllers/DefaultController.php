<?php

class DefaultController extends ManagerController {

    public function actionIndex() {
        $user = User::model()->findByAttributes(array('id'=>Yii::app()->user->id, 'role'=>'organisation'));
        if (!$user) {
            throw new CHttpException(403, 'У Вас не достаточно прав для доступа к этой странице.');
        }

        $model = new Purchase('search');
        $model->unsetAttributes();  // clear any default values
        if (isset($_GET['Purchase']))
            $model->attributes = $_GET['Purchase'];

        if (Yii::app()->user->role == 'organisation') {
            $model->org_id = Yii::app()->user->id;
            $model->status = 1;
        }

        $this->render('index', array('model' => $model));
    }

    public function actionArchive() {
        $user = User::model()->findByAttributes(array('id'=>Yii::app()->user->id, 'role'=>'organisation'));
        if (!$user) {
            throw new CHttpException(403, 'У Вас не достаточно прав для доступа к этой странице.');
        }

        $model = new Purchase('search');
        $model->unsetAttributes();  // clear any default values
        if (isset($_GET['Purchase']))
            $model->attributes = $_GET['Purchase'];

        if (Yii::app()->user->role == 'organisation') {
            $model->org_id = Yii::app()->user->id;
            $model->status = 2;
        }

        $this->render('archive', array('model' => $model));
    }

    /**
     * Displays a particular model.
     * @param integer $id the ID of the model to be displayed
     */
    public function actionView($id) {
        $model = Purchase::model()->findByPk((int) $id);
        if ($model->coupon->act->id_org_act != Yii::app()->user->id || Yii::app()->user->role != 'organisation') {
            throw new CHttpException(403, 'У Вас не достаточно прав для доступа к этой странице.');
        }
        $this->render('view', array(
            'model' => $model,
        ));
    }

    public function actionActivation($id) {
        $model = Purchase::model()->findByPk((int) $id);
        if ($model->coupon->act->id_org_act != Yii::app()->user->id || Yii::app()->user->role != 'organisation') {
            throw new CHttpException(403, 'У Вас не достаточно прав для доступа к этой странице.');
        }
        $model->status = Purchase::STATUS_ACTIVATED;
        $model->save();

        // Добавляем покупателю бонусов
        $model->user->raiseBonus();
        $this->redirect(array('index'));
    }

}