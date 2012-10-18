<?php
/**
 * Компонент для рассылки писем
 * Рссылка писем из очереди ожидания
 * User: igor (turcaigor@gmail.com)
 * Date: 02.10.12 22:39
 */

Yii::import('application.models.Act');

class CMailer
{
    // Количество писем для
    // отправления за один раз
    const SEND_ITEMS_BY_CALL = 10;

    /**
     * Типы уведомлений
     * Смотреть в CMailer(Типы уведомлений)
     *
     * ntf_1 // в конце месяца - количество ново-зарегенных юзеров как через соц.сети так и напрямую
     * ntf_2 // в конце месяца - количество проданных купонов
     * ntf_3 // Уведомлялка когда купон купили а не активировали и срок действия такого купона подходит к концу
     *          (уведомлялка каждый день в течении 3х последних дней)
     */


    /**
     * Добавление письма в очередь для отправки
     * @static
     * @param string $subject
     * @param string $body
     * @param string $recipientEmail
     * @param null $send_since_date
     * @return bool
     */
    protected static function addToQueue($subject, $body, $recipientEmail, $send_since_date=null)
    {
        $model = new Mailing();
        $model->subject = $subject;
        $model->body = $body;
        $model->recipientEmail = $recipientEmail;
        if ($send_since_date)
            $model->send_since_date = $send_since_date;
        return $model->save();
    }

    /**
     * Проверяем если шаблон есть
     * @static
     * @param $template
     * @return bool
     */
    protected static function getTemplateExists($template)
    {
        return file_exists(self::getTemplatePath($template));
    }

    /**
     * Рендерим шаблон письма
     * @static
     * @throws CHttpException
     * @param $template
     * @param array $viewData
     * @return string
     */
    protected static function getRenderTemplateData($template, array $viewData=array())
    {
        if(!self::getTemplateExists($template))
            throw new CHttpException(500, 'Не найден шаблон письма');

        $CController = new CController('mailer');
        $content = $CController->renderFile(self::getTemplatePath($template), $viewData, true);
        $_viewData = array(
            '_companyName_' => Option::getCompanyName(),
            '_websiteUrl_' => Option::getWebsiteUrl(),
            '_websiteLink_' => Option::getWebsiteLink(),
            '_content_' => $content,
        );
        $page = $CController->renderFile(self::getTemplatePath('layout'), $_viewData, true);
        return $page;
    }

    protected static function getTemplatePath($template)
    {
        return Yii::getPathOfAlias('application.components.views.emailTemplates') . '/' . $template . '.php';
    }


    /***********************************************************************************/
    /*                   Уведомления для админов и организаций                         */
    /***********************************************************************************/


    /**
     * Создаем уведомление о новой акции
     * @static
     * @param Act $actModel
     * @param array $params
     * @return bool
     */
    public static function addNewActNotification(Act $actModel, $params=array())
    {
        if (!$actModel->is_active || $actModel->is_published)
            return false;

        $mainAdmin = User::getMainAdmin();
        $subject = 'New Act Added!';
        $viewData = array(
            '_act_' => $actModel,
            '_mainAdmin_' => $mainAdmin
        );
        $body = self::getRenderTemplateData('newAct', $viewData);
        $actModel->is_published = 1;
        $actModel->save();

        return self::addToQueue($subject, $body, $mainAdmin->email);
    }

    /**
     * Проверяем акции на актуальность
     * если акция не актуальна она переходит в прошедшие
     * и создаем уведомление
     * @static
     * @return int
       TODO: Шаблон
     */
    public static function addPastActsNotifications()
    {
        $criteria = new CDbCriteria();
        $criteria->condition = Act::getPastActCondition();
        $criteria->addInCondition('sent_past_notification', array(false));
        $models = Act::model()->findAll($criteria);
        $mainAdmin = User::getMainAdmin();

        foreach ($models as $model) {
            $subject = 'Subject';
            $params = array();
            $body = self::getRenderTemplateData('pastAct', $params);
            self::addToQueue($subject, $body, $mainAdmin->email);
            $model->sent_past_notification = true;
            $model->save();
        }
        return count($models);
    }


    /**
     * Проверяем окончание срока действия купонов
     * и создаем уведомление для просроченных акций
     * @static
     * @return void
       TODO: Шаблон
     */
    public static function addExpiredCouponsDateActsNotifications()
    {
        $criteria = new CDbCriteria();
        $criteria->condition = Act::getExpiredCouponsDateActCondition();
        $criteria->addInCondition('sent_expired_coupons_date_notification', array(0));
        $models = Act::model()->findAll($criteria);
        $mainAdmin = User::getMainAdmin();

        foreach ($models as $model)
        {
            $subject = 'Subject';
            $params = array();
            // TODO: получение кол-ва проданных и "активированных" купонов такой-то акции $model
            $body = self::getRenderTemplateData('expiredCoupunsDate', $params);
            self::addToQueue($subject, $body, $mainAdmin->email);
            $model->sent_expired_coupons_date_notification = 1;
            $model->save();
        }
    }

    /**
     * Уведомления в конце каждого месяца
     * Количество ново-зарегенных юзеров как через соц.сети так и напрямую.
     * +количество проданных купонов.
     * @static
     * @return array
       TODO: Шаблон
     */
    public static function addMonthlyInfoNotification()
    {
        $result = array(
            'newUsersCount' => 0,
            'soldCouponsCount' => 0
        );
        
        if (!self::getTodayIsLastDayOfMonth())
            return $result;

        $mainAdmin = User::getMainAdmin();

        // количество ново-зарегенных юзеров как через соц.сети так и напрямую
        $criteria = new CDbCriteria();
        $criteria->addInCondition('ntf_1', array(0));
        $criteria->addInCondition('superuser', array(0));
        $newUsersCount = User::model()->count($criteria);
        User::model()->updateAll(array('ntf_1'=>1), $criteria);

        // количество проданных купонов
        $criteria = new CDbCriteria();
        $criteria->addInCondition('ntf_2', array(0));
        $soldCouponsCount = Coupon::model()->count($criteria);
        Coupon::model()->updateAll(array('ntf_2'=>1), $criteria);

        $subject = 'Subject';
        $params = array();
        $body = self::getRenderTemplateData('monthlyInfoNotification', $params);
        self::addToQueue($subject, $body, $mainAdmin->email);

        $result['newUsersCount'] = $newUsersCount;
        $result['soldCouponsCount'] = $soldCouponsCount;

        return $result;
    }


    /***********************************************************************************/
    /*                         Уведомления для пользователей                           */
    /***********************************************************************************/


    /**
     * Уведомление о регистрации пользоаетеля на сайте
     * Отправляется СРАЗУ
     * @static
     * @param User $userModel
     * @param array $params
     * @return bool
     */
    public static function sendUserRegistrationNtf(User $userModel, array $params=array())
    {
        $subject = 'Вы зарегистрировались на сайте ' . Option::getByName('company_url');
        $viewData = array(
            '_user_' => $userModel,
            '_password_' => $params['password'],
        );

        $body = self::getRenderTemplateData('userRegistration', $viewData);
        return self::sendEmail($userModel->email, $subject, $body);
    }

    /**
     * Востановление пароля
     * Отправляется СРАЗУ
     * @static
     * @param User $userModel
     * @param array $params
     * @return bool
     */
    public static function sendUserPassRecoveryNtf(User $userModel, array $params=array())
    {
        $subject = 'Востановление пароля на сайте ' . Option::getByName('company_url');
        $url = Option::getWebsiteUrl() . '/site/recovery?key=' . $params['activationKey'];
        $activationLink = CHtml::link('ссылке', $url);
        $viewData = array(
            '_user_' =>$userModel,
            '_activationLink_' => $activationLink
        );
        $body = self::getRenderTemplateData('userPassRecovery', $viewData);

        return self::sendEmail($userModel->email, $subject, $body);
    }

    /**
     * При покупке купона уведомление о факте покупки,
     * сам купленный купон(ы)
     * Отправляется СРАЗУ
     * @static
     * @param User $userModel
     * @param array $couponModels модели купонов
     * @param array $params
     * @return bool
     */
    public static function sendUserCouponBoughtNtf(User $userModel, array $couponModels, array $params=array())
    {
        $subject = 'Приобретённые купоны на сайте ' . Option::getByName('company_url');
        $viewData = array(
            '_user_' => $userModel,
            '_coupons_' => $couponModels,
        );
        $body = self::getRenderTemplateData('userCouponBought', $viewData);

        $attachments = array();
        foreach ($couponModels as $purchase) {
            $s = DIRECTORY_SEPARATOR;
            $rootPath = dirname(Yii::getPathOfAlias('application')) . $s;
            $uploadsPath = $rootPath . 'upload' . $s . 'coupons';
            $attachments[] = array(
                'filepath' => $uploadsPath.$s.$purchase->picture,
                'name' => $purchase->secret_key . '.jpg',
            );
        }

        return self::sendEmail($userModel->email, $subject, $body, $attachments);
    }

    /**
     * При зачислении бонусов и подтверждении купона
     * Отправляется СРАЗУ
     * @static
     * @param User $userModel
     * @param Coupon $couponModel
     * @param array $params
     * @return bool
       TODO: Шаблон
     */
    public static function sendUserCouponActivatedNtf(User $userModel, Coupon $couponModel, array $params=array())
    {
        $mainAdmin = User::getMainAdmin();
        $subject = 'Subject';
        $viewData = array();
        $body = self::getRenderTemplateData('userCouponBought', $viewData);

        return self::sendEmail($userModel->email, $subject, $body);
    }

    /**
     * При пополнении личного счёта на сайте
     * Отправляется СРАЗУ
     * @static
     * @param User $userModel
     * @param array $params
     * @return bool
       TODO: Шаблон
     */
    public static function sendUserFillUpBalanceNtf(User $userModel, $params=array())
    {
        $mainAdmin = User::getMainAdmin();
        $subject = 'Subject';
        $viewData = array();
        $body = self::getRenderTemplateData('userFillUpBalance', $viewData);

        return self::sendEmail($userModel->email, $subject, $body);
    }

    /**
     * Уведомлялка (coupon.ntf_3) когда купон купили а не активировали и срок действия такого купона подходит к концу
     * (уведомлялка каждый день в течении 3х последних дней)
     * @static
     * @return int
       TODO: Шаблон
     */
    public static function addUsersCouponExpiresNtfs()
    {
        $threeDaysBeforeCouponActivity = date('Y-m-d 00:00:00', strtotime('+ 2 days'));
        // выбираем купоны
        $criteria = new CDbCriteria();
        $criteria->join = 'LEFT JOIN act ON t.act_id=act.id_act';
        $criteria->addCondition("t.status =  1");
        $criteria->addCondition("t.ntf_3 IS FALSE");
        $criteria->addCondition("act.date_end_coupon_act = '{$threeDaysBeforeCouponActivity}'");
        $expiresPurchases = Purchase::model()->findAll($criteria);

        var_dump('count($expiresPurchases)', count($expiresPurchases));

        // создаем по 3 увдеомления (для 3-х последних дней)
        $subject = 'Subject';
        foreach ($expiresPurchases as $eachPurchase)
        {
            $viewData = array(
                'user' => $eachPurchase->user,
                'purchase' => $eachPurchase
            );
            $body = self::getRenderTemplateData('userCouponExpires', $viewData);
            self::addToQueue($subject, $body, $eachPurchase->user->email, time());
            self::addToQueue($subject, $body, $eachPurchase->user->email, strtotime('+ 1 day'));
            self::addToQueue($subject, $body, $eachPurchase->user->email, strtotime('+ 2 days'));
            $eachPurchase->ntf_3 = 1;
            $eachPurchase->save();
        }
    }


    /***********************************************************************************/
    /*                        Общие фун-ции, проверка акций и т.д.                     */
    /***********************************************************************************/


    /**
     * Проверяем если сегодня последний день месяца
     * @static
     * @return bool
     * TODO: протестить
     */
    public static function getTodayIsLastDayOfMonth()
    {
        //return date("Y-m-t", strtotime(date('Y-m-d'))) == date('Y-m-d');
        return true;
    }

    /**
     * @param $to
     * @param $subject
     * @param $body
     * @param array $attachments
     * @return bool|void
     */
    public function sendEmail($to, $subject, $body, $attachments=array())
    {
        $dir = Yii::getPathOfAlias('webroot.lists.admin.phpmailer');
        include_once $dir . '/classphpmailer.php';

        $mail = new PHPMailer();
        $mail->IsMail();
        $mail->CharSet = 'UTF-8';
        $mail->From = "noreply@reddot.com";
        $mail->FromName = "noreply@reddot.com";
        $mail->AddAddress($to);
        foreach ($attachments as $attachment)
            $mail->AddAttachment($attachment['filepath'], $attachment['name']);

        $mail->IsHTML(true);
        $mail->Subject = $subject;
        $mail->Body = $body;
        return $mail->Send();
    }
}