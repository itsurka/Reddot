<?php

class LinkPager extends CLinkPager {

    public $header = '';
    public $footer = '';

    public function init() {
        
    }

    public function run() {
        $this->registerClientScript();
        $buttons = $this->createPageButtons();
        if (empty($buttons))
            return;

        list($beginPage, $endPage) = $this->getPageRange();
        if ($this->getCurrentPage(false) == $endPage)
            return;

        if (isset($buttons[0]))
            echo $buttons[0];
    }

    protected function createPageButtons() {
        if (($pageCount = $this->getPageCount()) <= 1)
            return array();

        $currentPage = $this->getCurrentPage(false);
        $buttons = array();

        if (($page = $currentPage + 1) >= $pageCount - 1)
            $page = $pageCount - 1;

        return array($this->render('linkPager', array('link' => $this->createPageUrl($page)), true));
    }

}