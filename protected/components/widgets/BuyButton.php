<?php

class BuyButton extends CWidget {

    public $act = null;

    public function run() {
        /**
         * So, here we should check whether currents action has child actions, or not
         */
        $childActions = Act::model()->findAllByAttributes(array('paid' => $this->act->id_act));

        if (count($childActions)) {
            array_unshift($childActions, $this->act);
        }
        else {
            $childActions = false;
        }

        //print_r($childActions);
        $this->render('buy_button', array('act' => $this->act, 'childActions' => $childActions));
    }

}