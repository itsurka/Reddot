<?php

class UserController extends Controller {

    /**
     * @var string the default layout for the views. Defaults to '//layouts/column2', meaning
     * using two-column layout. See 'protected/views/layouts/column2.php'.
     */
    public $layout = '//layouts/profile';

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
                'actions' => array('index', 'view', 'town', 'login', 'ulogin', 'register'),
                'users' => array('*'),
            ),
            array('allow', // allow authenticated user to perform 'create' and 'update' actions
                'actions' => array('ajaxSendCoupon', 'update', 'logout', 'profile', 'ajaxGetCoupon', 'ajaxActivationCoupon', 'operations', 'buy', 'sucess', 'fail', 'image'),
                'users' => array('@'),
            ),
//            array('allow', // allow admin user to perform 'admin' and 'delete' actions
//                'actions' => array('admin', 'delete'),
//                'users' => array('admin'),
//            ),
            array('deny', // deny all users
                'users' => array('*'),
            ),
        );
    }

    /**
     * Updates a particular model.
     * If update is successful, the browser will be redirected to the 'view' page.
     */
    public function actionUpdate() {
        /** @var $model User */
        $model = User::model()->findByPk(Yii::app()->user->id);
        $model->setScenario('update');
        $hashPassword = $model->password;

        // if it is ajax validation request
        if (isset($_POST['ajax']) && $_POST['ajax'] === 'user-profile') {
            if (isset($_POST['User']['subscribe'])) {
                $model->setSubscribe((bool) $_POST['User']['subscribe']);
            }
            echo CActiveForm::validate($model);
            Yii::app()->end();
        }

        $save = false;
        if (isset($_POST['User'])) {
            $model->attributes = $_POST['User'];
            $newPassword = User::hashPassword($model->password);

            if (User::ROLE_ORG == $model->role) {
                $this->saveAddresses();
            }

            if (trim($model->password) && $hashPassword != $newPassword) {
                $model->password = $newPassword;
            } else {
                $model->password = $hashPassword;
            }
            $save = true;
//            if($model->save()) {
//                $this->redirect( array( 'update' ) );
//            }
        }

        $this->render('update', array(
            'save' => $save,
            'model' => $model,
        ));
    }

    /**
     * Сохранить адреса пользователя
     */
    private function saveAddresses() {
        if (isset($_POST['UsersAddress']['address']) && is_array($_POST['UsersAddress']['address'])) {
//            var_dump( $_POST['UsersAddress']['address'] );
            foreach ($_POST['UsersAddress']['address'] as $addrId => $addrVal) {
                $addrVal = trim($addrVal);
                /** @var $address UsersAddress */
                $address = UsersAddress::model()->findByPk($addrId);

//                var_dump( $address );

                if ($addrVal) {
                    if (null === $address) {
                        $address = new UsersAddress();
                        $address->address = $addrVal;
                        $address->user_id = Yii::app()->user->id;
                    } else {
                        $address->address = $addrVal;
                    }
                    $address->save();
                }

                if (!$addrVal) {
                    if (null !== $address) {
                        $address->delete();
                    }
                }
            }
        }
    }

    public function actionTown($id) {
        $town = Town::model()->findByPk((int) $id);
        if ($town) {
            if (Yii::app()->user->isGuest) {
                Yii::app()->user->setState('town', $id);
            } else {
                User::model()->updateByPk(Yii::app()->user->id, array(
                    'id_towns_user' => $town->id_towns,
                ));
            }

            $this->redirect(Yii::app()->request->urlReferrer);
        }

        throw new CHttpException(404, 'Такой страницы не существует.');
    }

    /**
     * Edit user profile
     */
    public function actionProfile() {
        $model = new Purchase('search');
        if (isset($_GET))
            $model->setAttributes($_GET);

        if (!$model->status)
            $model->status = Purchase::STATUS_NOT_ACTIVATED;

        $model->user_id = Yii::app()->user->id;
        $dataProvider = $model->userSearch();

        if (Yii::app()->request->isAjaxRequest)
            $this->renderPartial('_purchaseItemsList', array('dataProvider' => $dataProvider));
        else
            $this->render('profile', array('dataProvider' => $dataProvider));
    }

    public function actionAjaxGetCoupon() {
        if (Yii::app()->request->isAjaxRequest) {
            if (isset($_POST['couponId'])) {
                $model = Purchase::model()->findByPk((int) $_POST['couponId']);
                if ($model && $model->user_id == Yii::app()->user->id) {
                    $this->renderPartial('_couponPopup', array('model' => $model));
                    Yii::app()->end();
                }
            }
        }

        throw new CHttpException(404, 'Такой страницы не существует.');
    }

    /**
     * Displays the login page
     */
    public function actionLogin() {
        $this->layout = '//layouts/column2';
        $model = new User('login');

        // if it is ajax validation request
        if (isset($_POST['ajax']) && $_POST['ajax'] === 'login-form') {
            echo CActiveForm::validate($model);
            Yii::app()->end();
        }


        if (isset($_POST['User'])) {
            $model->attributes = $_POST['User'];
            if ($model->validate()) {
                if ($model->authenticate()) {
                    $this->redirect(Yii::app()->user->getReturnUrl());
                }
            }
        }

        $this->render('login', array('model' => $model));
    }

    /**
     * Sing in http://ulogin.ru
     *
     * $user['network'] - соц. сеть, через которую авторизовался пользователь
     * $user['identity'] - уникальная строка определяющая конкретного пользователя соц. сети
     * $user['uid'] - id пользователя соц. сети
     * $user['first_name'] - имя пользователя
     * $user['last_name'] - фамилия пользователя
     */
    public function actionUlogin() {
        $this->layout = '//layouts/column2';
        if (!isset($_POST['token'])) {
            print 'token undefined';
            return;
        }

        $s = file_get_contents('http://ulogin.ru/token.php?token=' . $_POST['token'] . '&host=' . $_SERVER['HTTP_HOST']);
        $user = json_decode($s, true);

//        var_dump( $user );
//        return;
        if (!isset($user['network']) || !isset($user['uid'])) {
            print 'error authentificate';
            return;
        }

        /** @var $userObj User */
        $userObj = new User('ulogin');
        $userObj->soc_network = $user['network'];
        $userObj->soc_uid = $user['uid'];
        $userObj->first_name = $user['first_name'];
        $userObj->username = $user['first_name'];
        $userObj->last_name = $user['last_name'];
        if (isset($user['email'])) {
            $userObj->email = $user['email'];
        }

        if ($userObj->uauthenticate()) {
            $this->redirect(Yii::app()->user->getReturnUrl());
        }

        $this->render('uerror', array('model' => $userObj));
    }

    public function actionRegister() {
        $this->layout = '//layouts/column2';
        $model = new User('register');

        // if it is ajax validation request
        if (isset($_POST['ajax']) && $_POST['ajax'] === 'register-form') {
            echo CActiveForm::validate($model);
            Yii::app()->end();
        }

        if (isset($_POST['User'])) {
            $model->setAttributes($_POST['User']);
            $model->password = User::hashPassword($model->password);
            if ($model->save()) {
                $model->authenticate(true);
                $this->redirect(Yii::app()->user->getReturnUrl());
            }
        }

        $this->render('register', array('model' => $model,));
    }

    /**
     * Logs out the current user and redirect to homepage.
     */
    public function actionLogout() {
        Yii::app()->user->logout();
        $this->redirect(Yii::app()->homeUrl);
    }

    public function actionOperations() {
        $model = new Operation('search');
        $model->unsetAttributes();
        $model->user_id = Yii::app()->user->id;

        $this->render('operations', array('model' => $model));
    }

    public function actionImage($id) {
        $model = Purchase::model()->findByPk((int) $id);
        if ($model->user_id != Yii::app()->user->id)
            throw new CHttpException(404, 'Такой страницы не существует.');

        $file = $model->getPictureFile();
        header("Content-type: image/jpeg");
        header("Accept-Ranges: bytes");
        header("Content-Length: " . filesize($file));
        header("Content-Disposition: attachment; filename=" . $model->picture . '.jpg');
        readfile($file);

        Yii::app()->end();
    }

    public function actionAjaxSendCoupon() {
        if (Yii::app()->request->isAjaxRequest) {
            if (isset($_POST['couponId']) && isset($_POST['email'])) {
                $model = Purchase::model()->findByPk((int) $_POST['couponId']);
                if ($model->user_id == Yii::app()->user->id) {
                    $email = Yii::app()->email;
                    $email->to = $_POST['email'];
                    $email->subject = 'Вам подарили купон!';
                    $email->message = 'Код купона: <b>' . $model->secret_key . '</b>';
                    $email->send();

                    Yii::app()->end();
                }
            }
        }

        throw new CHttpException(404, 'Такой страницы не существует.');
    }

}