<?php

class ActListWidget extends CWidget {

    public $model;
    public $dataProvider = null;

    public function run() {
        $condition = "
            is_bonus = {$this->model->is_bonus} AND 
            (date_start_act <= NOW() AND 
            date_end_act >= NOW()) and 
            paid = 0 AND 
            is_bonus = {$this->model->is_bonus} AND
            id_themes_act = {$this->model->id_themes_act} AND
            id_act != {$this->model->id_act}";

        if (!$this->dataProvider)
            $this->dataProvider = Act::model()->search($condition, 4);

        if ($this->dataProvider->getData())
            $this->render('actListWidget');
    }

}