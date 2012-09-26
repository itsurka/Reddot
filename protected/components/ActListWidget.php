<?php

class ActListWidget extends CWidget {

    public $model;
    public $dataProvider = null;

    public function run() {
        $condition = "
            is_bonus = {$this->model->is_bonus}
            AND (date_start_act <= NOW() AND date_end_act >= NOW())
            AND paid = 0
            AND is_bonus = {$this->model->is_bonus}
            AND id_themes_act = {$this->model->id_themes_act}
            AND id_act != {$this->model->id_act}
            AND is_active IS TRUE
            AND (coupon_count > coupon_purchased OR coupon_count = 0)";

        if (!$this->dataProvider)
            $this->dataProvider = Act::model()->search($condition, 4);

        if ($this->dataProvider->getData())
            $this->render('actListWidget');
    }

}