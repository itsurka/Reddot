<?php

class ActFilterThemesWidget extends ActFilterWidget {

    public $models = array();

    public function init() {
        parent::init();
    }

    public function run() {
        parent::run();
        $this->models = Theme::model()->findAll();
        $this->render('actFilterThemesWidget');
    }

}