<ul class="breadcrumb">
    <li>
        <a href="<?php echo Yii::app()->createUrl('admin'); ?>">Панель управления</a> &rarr;
        Рассылки
    </li>
</ul>
<div class="row">
    <div class="span9">
        <div>
            <div>
                <h2 class="pull-left">Управление рассылками</h2>
                <a href="<?php echo Yii::app()->createUrl('admin/mailing/create'); ?>" class="btn btn-success pull-right" type="submit">
                    Новая рассылка
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
                'id:#',
                'subject',
                array(
                    'name' => 'type',
                    'value' => '$data->type ? $data->typesListData[$data->type] : "Всем"',
                    'filter' => Mailing::model()->typesListData,
                ),
                array(
                    'name' => 'town_id',
                    'value' => '$data->town_id ? $data->town->name_towns : "Любой город"',
                    'filter' => CHtml::listData(Town::model()->findAll(), 'id_towns', 'name_towns'),
                ),
                array(
                    'name' => 'status',
                    'value' => '$data->statusListData[$data->status]',
                    'filter' => Mailing::model()->statusListData,
                ),
                array(
                    'class' => 'CButtonColumn',
                    'template' => '{update} {delete}',
                ),
            ),
        ));
        ?>
    </div>
    <div class="span3" style="margin-top: 100px;">
        <div class="well">
            <?php $form = $this->beginWidget('CActiveForm', array('action' => Yii::app()->createUrl($this->route))); ?>

            <label style="font-weight: bold;">Искать в теме:</label>
            <?php echo $form->textField($model, 'subject'); ?>

            <label style="font-weight: bold;">Тип рассылки:</label>
            <?php echo $form->dropDownList($model, 'type', array('' => '') + Mailing::model()->typesListData); ?>

            <label style="font-weight: bold;">Город:</label>
            <?php echo $form->dropDownList($model, 'town_id', array('' => '') + Town::model()->getTownsListData()); ?>


            <label style="font-weight: bold;">Статус рассылки:</label>
            <?php echo $form->dropDownList($model, 'status', array('' => '') + Mailing::model()->statusListData); ?>

            <?php $this->endWidget(); ?>
        </div>
    </div>
</div>