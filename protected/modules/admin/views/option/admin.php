<ul class="breadcrumb">
    <li>
        <a href="<?php echo Yii::app()->createUrl('admin'); ?>">Панель управления</a> &rarr;
        Опции
    </li>
</ul>
<div class="row">
    <div class="span9">
        <div>
            <div>
                <h2 class="pull-left">Редактирование типов опций</h2>
                <a href="<?php echo Yii::app()->createUrl('admin/option/create'); ?>" class="btn btn-success pull-right" type="submit">
                    Добавить опцию
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
                'name',
                'title',
                array
                    (
                    'name' => 'type',
                    'value' => '$data->getOptionName()', // display the 'name' attribute of the 'category' relation
                    'filter' => array('global' => 'Глобальная', 'local' => 'Локальная')
                ),
                'default_value',
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

            <label style="font-weight: bold;">Строка обозначание:</label>
            <?php echo $form->textField($model, 'name'); ?>

            <label style="font-weight: bold;">Человекочитаемое название:</label>
            <?php echo $form->textField($model, 'title'); ?>

            <label style="font-weight: bold;">Тип:</label>
            <?php echo $form->dropDownList($model, 'type', array('' => '', 'global' => 'Глобальная', 'local' => 'Локальная')); ?>

            <label style="font-weight: bold;">Дефолтное значение:</label>
            <?php echo $form->textField($model, 'default_value'); ?>

            <?php $this->endWidget(); ?>
        </div>
    </div>
</div>