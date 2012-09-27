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
        $purchaseByBonus = false;
        if ($CHttpRequest->getParam('bonus') !== null)
            $purchaseByBonus = true;

        $operation = new Operation;
        $operations = $operation->paymentPurchase($purchaseByBonus);

//        $this->render('purchase', array('operations' => $operations));
        $this->redirect('/user/profile');
    }

}
