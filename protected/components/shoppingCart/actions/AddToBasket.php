<?php

/**
 * User: Kuklin Mikhail (mikhail@clevertech.biz)
 * Company: Clevertech LLC.
 * Date: 11.07.12 17:38
 */
class AddToBasket extends CAction {

    public function run($act_id) {
        $coupon = Coupon::model()->findByPk($act_id);
        if ($coupon) {
            Yii::app()->shoppingCart->put($coupon, 1);
            $return['small'] = $this->getController()->widget('application.components.widgets.Basket', array(), true);
            $return['full'] = $this->getController()->widget('application.components.widgets.Basket', array('mode' => 'full'), true);
            echo json_encode($return);
        } else {
            throw new CHttpException(404, 'Not found');
        }
    }
}