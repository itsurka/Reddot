<ul class="breadcrumb">
    <li>
        <a href="<?php echo Yii::app()->createUrl('admin'); ?>">Панель управления</a> &rarr;
        Распродажи
    </li>
</ul>
<div class="row">
    <div class="span9">
        <div>
            <div>
                <h2 class="pull-left">Управление распродажами</h2>
                <a href="<?php echo Yii::app()->createUrl('admin/sale/create'); ?>" class="btn btn-success pull-right" type="submit">
                    Создать распродажу
                </a>
            </div>
            <div style="clear:both;"></div>
            <hr />
        </div>
        <?php
        $this->widget('zii.widgets.grid.CGridView', array(
            'id' => 'grid',
            'dataProvider' => $model->search(),
            'itemsCssClass' => 'table table-striped',
            'summaryText' => '',
            'columns' => array(
                array(
                    'name' => 'id',
                    'header' => '#',
                ),
                array(
                    'name' => 'start',
                    'value' => 'Yii::app()->dateFormatter->format("d MMMM yyyy в HH:mm", $data->start)',
                    'filter' => false,
                ),
                array(
                    'name' => 'finish',
                    'value' => 'Yii::app()->dateFormatter->format("d MMMM yyyy в HH:mm", $data->finish)',
                    'filter' => false,
                ),
                array(
                    'class' => 'CButtonColumn',
                    'template' => '{update} {delete}',
                ),
            ),
        ));
        ?>
    </div>
</div>