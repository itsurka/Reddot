<?php

class ReplanishmentWidget extends CWidget {

    public function init() {
        parent::init();
    }

    public function run() {
        parent::run();

        $this->render('replenishment');
    }

}