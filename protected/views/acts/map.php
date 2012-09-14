<?php $this->setPageTitle('Акции на карте'); ?>
<?php Yii::app()->clientScript->registerMetaTag('Акции на карте', 'description'); ?>
<?php Yii::app()->clientScript->registerMetaTag('Акции на карте', 'keywords'); ?>

<td id="content_all" valign="top">
    <?php $this->widget('YandexMaps', array('dataProvider' => $mapsDataProvider)); ?>
    <div id="acts_container">
        <?php $this->renderPartial('_map', array('dataProvider' => $dataProvider)) ?>
    </div>
</td>