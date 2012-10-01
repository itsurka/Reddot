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

    /**
     * Востановление доступа к сайту
     * @return void
     */
    public function actionRecovery() {
        $this->layout = '//layouts/empty';
        $return = array(
            'errorMessage' => '',
            'message' => '',
            'insertNewPass' => false,
            'recoverySucces' => false
        );
        $CHttpRequest = new CHttpRequest();
        if ($CHttpRequest->getIsPostRequest() && $CHttpRequest->getParam('key')===null) {
            if ($CHttpRequest->getParam('email') && filter_var($CHttpRequest->getParam('email'), FILTER_VALIDATE_EMAIL)) {
                $email=$CHttpRequest->getParam('email');
                $user = User::model()->findByAttributes(array('email'=>$CHttpRequest->getParam('email')));
                if ($user) {

                    $sendActivationKey = md5($user->id);
                    $activationKey = md5($sendActivationKey);

                    $url = Yii::app()->getBaseUrl(true) . Yii::app()->urlManager->createUrl('site/recovery', array('key'=>$sendActivationKey));
                    $activationLink = CHtml::link('ссылке', $url);

                    $html = "
                            <html>
                            <head>
                              <title>Востановление пароля</title>
                            </head>
                            <body>
                                Здравствуйте {$user->first_name} {$user->last_name}!
                                <br>
                                <br>
                                Для востановления пароля Вам нужно перейти по {$activationLink}
                            </body>
                            </html>";

                    // To send HTML mail, the Content-type header must be set
                    $headers  = 'MIME-Version: 1.0' . "\r\n";
                    $headers .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";

                    // Additional headers
                    $from = $_SERVER['HTTP_HOST'];
                    $headers .= "To: {$user->first_name} <{$user->email}>" . "\r\n";
                    $headers .= "From: <no-reply@{$from}>" . "\r\n";

                    $result = mail($user->email, 'Востановление пароля', $html, $headers);
                    if (!$result)
                        throw new CHttpException('Не удалось отправть письмо', 500);

                    $user->activationKey = $activationKey;
                    $user->save();

                    $return['message'] = "Письмо для востановления пароля отправлено по адресу <strong>{$email}</strong>";
                }
                else
                    $return['errorMessage'] = 'Пользователь не найден';
            }
            else
                $return['errorMessage'] = 'Неверный e-mail адрес';
        } elseif($CHttpRequest->getParam('key')) {
            // check activation key
            $user = User::model()->findByAttributes(array('activationKey' => md5($CHttpRequest->getParam('key'))));

            if ($user) {
                $return['insertNewPass'] = true;

                if ($CHttpRequest->getIsPostRequest()) {
                    if ($CHttpRequest->getParam('password') && strlen($CHttpRequest->getParam('password'))>5) {
                        if ($CHttpRequest->getParam('password') == $CHttpRequest->getParam('passwordControl')) {
                            $return['recoverySucces'] = true;
                            $user->password = User::hashPassword($CHttpRequest->getParam('password'));
                            $user->activationKey = '';
                            $user->save();
                        }
                        else
                            $return['errorMessage'] = 'Пароли не совпадают';
                    }
                    else
                        $return['errorMessage'] = 'Введите пароль(мин. 6 символов)';
                }
            }
            else
                $return['errorMessage'] = 'Неверный код активации';
        }
        $this->render('recovery', array('return' => $return));
    }
}