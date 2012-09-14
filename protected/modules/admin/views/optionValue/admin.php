<ul class="breadcrumb">
    <li>
        <a href="<?php echo Yii::app()->createUrl('admin'); ?>">Панель управления</a> &rarr;
        Редактирование опций
    </li>
</ul>
<div class="row">
    <div class="span9">
        <div>
            <div>
                <h2 class="pull-left">Редактирование опций</h2>
                <a href="<?php echo Yii::app()->createUrl('admin/optionValue/create'); ?>" class="btn btn-success pull-right" type="submit">
                    Добавить новое значение
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
                'id',
                array(
                    'name' => 'option_id',
                    'value' => '$data->option->title',
                    'filter' => CHtml::listData(Option::model()->findAll(), "id", "title")
                ),
                array(
                    'name' => 'towns_id',
                    'value' => '$data->town->name_towns',
                    'filter' => CHtml::listData(Town::model()->findAll(), "id_towns", "name_towns")
                ),
                'value',
                array(
                    'class' => 'CButtonColumn',
                    'template' => '{update} {delete}'
                ),
            ),
        ));
        ?>
    </div>
    <div class="span3" style="margin-top: 100px;">
        <div class="well">
            <?php $form = $this->beginWidget('CActiveForm', array('action' => Yii::app()->createUrl($this->route))); ?>

            <label style="font-weight: bold;">Искать в значении:</label>
            <?php echo $form->textField($model, 'value'); ?>

            <label style="font-weight: bold;">Опция:</label>
            <?php echo $form->dropDownList($model, 'option_id', array('' => '') + CHtml::listData(Option::model()->findAll('type=\'local\''), 'id', 'title')); ?>

            <label style="font-weight: bold;">Привязанный город:</label>
            <?php echo $form->dropDownList($model, 'towns_id', array('' => '') + Town::model()->getTownsListData()); ?>

            <?php $this->endWidget(); ?>
        </div>
    </div>
</div>