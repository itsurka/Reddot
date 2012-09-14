<?php

class UserDialogWidget extends CWidget {

    public function init() {
        parent::init();
    }

    public function run() {
        parent::run();
        $this->render('userDialogWidget');
    }

}