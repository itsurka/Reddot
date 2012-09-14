<?php

class PageController extends Controller {

    public $layout = 'column2';

    public function actionView($pageName) {
        $model = Page::model()->findByAttributes(array(
            'name' => CHtml::encode($pageName),
        ));

        $this->render('view', array('model' => $model));
    }

}