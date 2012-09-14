<?php

class Disqus extends CWidget {

    public function init() {
        $this->_initScript();
    }

    public function run() {
        $this->render('disqus');
    }

    private function _initScript() {
        $script = '';
        $script .= "
            var disqus_shortname = 'reddott'; // required: replace example with your forum shortname
            (function() {
                var dsq = document.createElement('script'); dsq.type = 'text/javascript'; dsq.async = true;
                dsq.src = 'http://' + disqus_shortname + '.disqus.com/embed.js';
                (document.getElementsByTagName('head')[0] || document.getElementsByTagName('body')[0]).appendChild(dsq);
            })();
        ";

        Yii::app()->clientScript->registerScript('disquos', $script, CClientScript::POS_END);
    }

}