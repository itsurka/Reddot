<?php

/**
 * User: Kuklin Mikhail (mikhail@clevertech.biz)
 * Company: Clevertech LLC.
 * Date: 11.07.12 17:38
 */
class UpdateBasket extends CAction {

    public function run($act_id, $amount) {
        $coupon = Coupon::model()->findByPk($act_id);
        if ($coupon) {
            Yii::app()->shoppingCart->update($coupon, $amount);
            $return['small'] = $this->getController()->widget('application.components.widgets.Basket', array(), true);
            $return['full'] = $this->getController()->widget('application.components.widgets.Basket', array('mode' => 'full'), true);
            echo json_encode($return);
        } else {
            throw new CHttpException(404, 'Not found');
        }
    }

}