<?php

/**
 * User: Kuklin Mikhail (mikhail@clevertech.biz)
 * Company: Clevertech LLC.
 * Date: 11.07.12 18:25
 */
class Basket extends CWidget {

    const MODE_SMALL = 'small';
    const MODE_FULL = 'full';

    public $mode = 'small';
    private $count;
    private $cost;
    private $positions;

    public function init() {
        $this->count = Yii::app()->shoppingCart->getItemsCount();
        $this->positions = Yii::app()->shoppingCart->getPositions();
        $this->cost = Yii::app()->shoppingCart->getCost();
    }

    public function run() {
        $word = Utils::wordAfterNum(array('купон', 'купона', 'купонов'), $this->count);
        $readable = $this->count . ' ' . $word;
        $this->render('basket_' . $this->mode, array(
            'count' => $this->count,
            'countWord' => $word,
            'countReadable' => $readable,
            'positions' => $this->positions,
            'cost' => $this->cost));
    }
}
