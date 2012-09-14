<?php

/**
 * User: Kuklin Mikhail (mikhail@clevertech.biz)
 * Company: Clevertech LLC.
 * Date: 11.07.12 17:38
 */
class DeleteFromBasket extends CAction {

    public function run($act_id) {
        $coupon = Coupon::model()->findByPk($act_id);
        if ($coupon) {
            Yii::app()->shoppingCart->remove($coupon->getId());
            $return['small'] = $this->getController()->widget('application.components.widgets.Basket', array(), true);
            $return['full'] = $this->getController()->widget('application.components.widgets.Basket', array('mode' => 'full'), true);
            echo json_encode($return);
            Yii::app()->end();
        } else {
            throw new CHttpException(404, 'Not found');
        }
    }

}
