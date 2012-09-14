<?php

class SiteController extends Controller {

    public $layout = 'column2';

    /**
     * Declares class-based actions.
     */
    public function actions() {
        return array(
            // captcha action renders the CAPTCHA image displayed on the contact page
            'captcha' => array(
                'class' => 'CCaptchaAction',
                'backColor' => 0xFFFFFF,
            ),
            // page action renders "static" pages stored under 'protected/views/site/pages'
            // They can be accessed via: index.php?r=site/page&view=FileName
            'page' => array(
                'class' => 'CViewAction',
            ),
        );
    }

    /**
     * This is the action to handle external exceptions.
     */
    public function actionError() {
        $this->layout = '//layouts/error';
        if (($error = Yii::app()->errorHandler->error)) {
            if (Yii::app()->request->isAjaxRequest)
                echo $error['message'];
            else
                $this->render('error', $error);
        }
    }

    /**
     * Displays the contact page
     */
    public function actionFeedback() {
        $model = new FeedbackForm;
        if (!Yii::app()->user->isGuest) {
            $model->setAttributes(array(
                'name' => Yii::app()->user->getDisplayName(),
                'email' => Yii::app()->user->getEmail(),
            ));
        }

        if (isset($_POST['FeedbackForm'])) {
            $model->attributes = $_POST['FeedbackForm'];
            if ($model->validate()) {
                $mail = Yii::app()->email;
                $mail->to = Yii::app()->params['adminEmail'];
                $mail->subject = $model->subject;
                $mail->message = $model->body;
                $mail->send();
                Yii::app()->user->setFlash('mailSended', 'Спасибо!<br />Ваше письмо успешно отправлено в службу поддержки. В скором времени Вам ответят');

                $this->refresh();
            }
        }

        $this->render('feedback', array('model' => $model));
    }

}