    <?php

    $this->widget('ListView', array(
        'dataProvider' => $dataProvider,
        'itemView' => '_purchaseItemView',
        'pager' => array('class' => 'LinkPager'),
        'template' => '{items}<br />{pager}',
        'baseScriptUrl' => Yii::app()->baseUrl . '/js/listview',
        'summaryText' => '',
        'emptyText' => '<div style="padding: 30px;text-align:center;">В этом разделе пока ещё нет ни одного купона.</div>',
    ));
    ?>