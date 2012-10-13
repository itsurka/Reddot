<?php

class OperationController extends Controller {

    public $layout = '//layouts/column2';

    public function actionQiwi() {
        /**
         * Пополнение счета и покупка тоаров
         */
        if (isset($_GET['type']) && $_GET['type'] == Operation::TYPE_PAYMENT_PURCHASE) {
            if (isset($_GET['mobile'])) {
                $purchases = array();
                $operation = new Operation();
                $operation->summ = Yii::app()->shoppingCart->getCost();
                $operation->user_id = Yii::app()->user->id;
                $operation->title = 'Пополнение баланса';
                $operation->type = Operation::TYPE_PAYMENT_PURCHASE;
                $operation->description = 'Пополнение баланса для приобретения товаров';

                foreach (Yii::app()->shoppingCart->getPositions() as $i => $pos) {
                    $purchases[$i]['id'] = $pos->id;
                    $purchases[$i]['quantity'] = $pos->getQuantity();
                    Yii::app()->shoppingCart->remove($pos->id);
                }

                $operation->extra = json_encode($purchases);
                if ($operation->save()) {
                    $from = Yii::app()->qiwi->login;
                    $qiwiLink = "http://w.qiwi.ru/setInetBill_utf.do?from={$from}&to={$_GET['mobile']}&summ={$operation->summ}&com={$operation->description}";
                    $this->redirect($qiwiLink);
                }
            } else {
                throw new CHttpException('Необходимо указать номер телефона');
            }
            /**
             * Пополнение счета
             */
        } else if (isset($_GET['type']) && $_GET['type'] == Operation::TYPE_DEPOSIT) {
            if (isset($_GET['mobile'])) {
                $purchases = array();
                $operation = new Operation();
                $operation->summ = $_GET['summ'];
                $operation->user_id = Yii::app()->user->id;
                $operation->title = 'Пополнение баланса';
                $operation->type = Operation::TYPE_DEPOSIT;
                $operation->description = 'Пополнение баланса на сайте';
                $operation->status = Operation::STATUS_WAITING; // ожидание проплаты
                if ($operation->save()) {
                    $from = Yii::app()->qiwi->login;
                    $qiwiLink = "http://w.qiwi.ru/setInetBill_utf.do?from={$from}&to={$_GET['mobile']}&summ={$operation->summ}&com={$operation->description}";
                    $this->redirect($qiwiLink);
                }
            } else {
                throw new CHttpException('Необходимо указать номер телефона');
            }
        }
    }

    public function actionQiwiUpdate() {
        Yii::app()->qiwi->updateBill();
    }

    public function actionPurchase() {
        $CHttpRequest = new CHttpRequest();
        if (Yii::app()->user->isGuest) {
            $CHttpSession = new CHttpSession();
            $CHttpSession->add('showBasketAfterLogin', true);
            $this->redirect('/?show_login=1');
        }
        $purchaseByBonus = false;
        if ($CHttpRequest->getParam('bonus') !== null)
            $purchaseByBonus = true;

        $operation = new Operation;
        $results = $operation->paymentPurchase($purchaseByBonus);

        if (!empty($results['boughtCoupons'])) {
            foreach ($results['boughtCoupons'] as $purchase)
                $this->generateCouponImage($purchase);
            $user = User::model()->findByPk(Yii::app()->user->id);
            CMailer::sendUserCouponBoughtNtf($user, $results['boughtCoupons']);
        }

        $this->redirect('/user/profile');
    }

    public function generateCouponImage($purchase) {
        $s = DIRECTORY_SEPARATOR;
        $rootPath = dirname(Yii::getPathOfAlias('application')) . $s;
        $imagePath = $rootPath . 'images' . $s . 'coupon.jpg';
        $uploadsPath = $rootPath . 'upload' . $s . 'coupons';
        $fontPath = $rootPath . 'fonts/13761.ttf';

        if (true)
        {
            $act = Act::model()->findByPk($purchase->act_id);

            $purchase->picture = md5($purchase->secret_key) . '.jpg';

            if(!is_dir($uploadsPath))
                mkdir($uploadsPath);

            $sourceImage = $rootPath . 'upload/coupons/sourceCoupon.jpg';
            $qrcode = $this->widget('ext.qrcode.QRCodeGenerator', array('data' => $purchase->secret_key), true);
            $arialBold =  $rootPath . 'fonts/arial_bold.ttf';
            $arial = $rootPath . 'fonts/arial.ttf';
            $arial = $arialBold;
            $actTitle = $act->name_act;
            $addresses = json_decode($act->user->address);
            $actWorkTime = 'Часы работы  ' . $act->user->working_time;
            $secretKey = $purchase->secret_key;
            $activeUntil = date('d.m.Y', strtotime($act->date_end_coupon_act));
            $websiteUrl = $_SERVER['HTTP_HOST'];
            $actTown = 'г. ' . $act->town->name_towns;
            $actTownEmail = $act->town->email;
            $actTownPhone = '';
            preg_match_all('/([0-9]{1}[0-9\-\)\(\ ]{1,})/', $act->town->description, $matches);
            if(!empty($matches[0])) $actTownPhone = $matches[0][0];

            $actTitleArray = Utils::strToArray($actTitle, 40);

            $img = WideImage::load($sourceImage);
            $watermark = WideImage::load(Yii::getPathOfAlias('webroot') . '/' . $qrcode);
            $img = $img->merge($watermark, 30, 100);

            // Пишем название акции
            $canvas = $img->getCanvas();
            $canvas->useFont($arialBold, 19, $img->allocateColor(0, 0, 0));
            /*$actTitleArray = array(
                'asdsadds ds sds sadadsad asf',
                'asdsadds ds sds sadadsad asf',
                'asdsadds ds sds sadadsad asf',
            );*/ // FOR TEST
            foreach($actTitleArray as $i=>$eachText)
                $canvas->writeText(180, 67 + (($i+1)*28), $eachText);

            // Пишем город покупателя ввреху справа
            $canvas->useFont($arial, 12, $img->allocateColor(43, 43, 43));
            $canvas->writeText(670, 30, $actTown);

            // Пишем адрес, телефон
            foreach($addresses as $i=>$eachAddress)
            {
                $canvas->useFont($arial, 12, $img->allocateColor(43, 43, 43));
                $canvas->writeText(330, 207 + ($i*18), $eachAddress->address);
            }

            // Пишем время работы
            $canvas->useFont($arial, 12, $img->allocateColor(43, 43, 43));
            $canvas->writeText(183, 231 + ((count($addresses)-1)*18), $actWorkTime);

            // Пишем ключ купона
            $canvas->useFont($arial, 34, $img->allocateColor(45, 152, 208));
            $canvas->writeText(180, 343, $secretKey);

            // Пишем краткое описание
            $shortTextArray = Utils::strToArray($act->short_text_act, 40);
            foreach($shortTextArray as $i=>$row)
            {
                if ($i>2) continue;
                $canvas->useFont($arial, 12, $img->allocateColor(43, 43, 43));
                $canvas->writeText(460, 340 + ($i*18), $row);
            }

            // Пишем дата активности
            $canvas->useFont($arial, 12, $img->allocateColor(43, 43, 43));
            $canvas->writeText(381, 418, $activeUntil);

            // Пишем адрес сайта
            $canvas->useFont($arial, 12, $img->allocateColor(43, 43, 43));
            $canvas->writeText('left + 40', 'bottom - 23', $websiteUrl);

            // Пишем телефон города покупателя
            $canvas->useFont($arial, 12, $img->allocateColor(43, 43, 43));
            $canvas->writeText('center', 'bottom - 23', $actTownPhone);

            // Пишем почту города покупателя
            $canvas->useFont($arial, 12, $img->allocateColor(43, 43, 43));
            $canvas->writeText('right - 40', 'bottom - 23', $actTownEmail);

            $imagePath = $uploadsPath . $s . $purchase->picture;
            $img->saveToFile($imagePath);

            $purchase->save();
        }

        return $uploadsPath . $s . $purchase->picture;
    }
}
