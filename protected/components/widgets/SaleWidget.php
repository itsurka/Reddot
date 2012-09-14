<?php

class SaleWidget extends CWidget {

    public $model = null;
    public $type = 'Popup';
    public $availableTypes = array('Popup', 'Timer');
    public $lastSale = null;

    function init() {
        parent::init();

        if (!in_array($this->type, $this->availableTypes)) {
            throw new CHttpException(404, 'Недопустимый тип');
        }
    }

    public function run() {
        parent::run();

        $this->lastSale = Sale::model()->getLastSale();
        $this->render("sale{$this->type}");
    }

}