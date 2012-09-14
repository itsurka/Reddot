<?php

class ActSearchWidget extends CWidget {

    public $model = null;

    public function init() {
        $this->model = new ActSearchForm();
        if (isset($_GET['ActSearchForm'])) {
            $this->model->setAttributes($_GET['ActSearchForm']);
        }

        if (isset($_GET)) {
            $this->model->setAttributes($_GET);
        }
    }

    public function run() {
        $this->render('actSearch');
    }

}