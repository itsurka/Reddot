<?php

Yii::import('zii.widgets.CListView');

class ListView extends CListView {

    public function renderPager() {
        if (!$this->enablePagination)
            return;

        $pager = array();
        $class = 'CLinkPager';
        if (is_string($this->pager))
            $class = $this->pager;
        else if (is_array($this->pager)) {
            $pager = $this->pager;
            if (isset($pager['class'])) {
                $class = $pager['class'];
                unset($pager['class']);
            }
        }
        $pager['pages'] = $this->dataProvider->getPagination();

        if ($pager['pages']->getPageCount() > 1) {
            echo '<table class="' . $this->pagerCssClass . '" align="center" width="712" cellpadding="0" cellspacing="0" border="0" height="60">';
            $this->widget($class, $pager);
            echo '</table>';
        }
        else
            $this->widget($class, $pager);
    }

}