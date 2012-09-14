<?php

class BalloonWidget extends CWidget {

    public $position = 'bottom center';
    public $contents = null;
    public $item = null;
    public $cssParams = array(
        'minWidth' => '20px',
        'padding' => '5px',
        'borderRadius' => '4px',
        'border' => 'solid 1px #777',
        'boxShadow' => '4px 4px 4px #555',
        'color' => '#666',
        'backgroundColor' => '#efefef',
        'opacity' => '1',
        'zIndex' => '32767',
        'textAlign' => 'left',
    );

    public function init() {
        $path = Yii::getPathOfAlias('application.components.widgets.assets') . '/jquery.balloon.min.js';
        $scriptFile = Yii::app()->assetManager->publish($path);

        $cs = Yii::app()->clientScript;
        $cs->registerScriptFile($scriptFile);
        $cs->registerScript('widgets/balloon', $this->_getScript());
    }

    private function _getScript() {
        $cssParams = CJavaScript::encode($this->cssParams);
        $script = "$('{$this->item}').balloon({
            position: '{$this->position}', contents: '{$this->contents}', css: {$cssParams}});";

        return $script;
    }

}