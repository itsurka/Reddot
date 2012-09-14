<?php

class ActListBonusWidget extends CWidget {

    public $models = array();

    public function init() {
        parent::init();

        $this->models = Act::model()->findAll(array(
            'condition' => 'is_bonus = 1 AND (date_start_act <= NOW() AND date_end_act >= NOW())',
            'limit' => 7,
        ));
    }

    public function run() {
        parent::run();
        $this->render('actListBonusWidget');
    }

}