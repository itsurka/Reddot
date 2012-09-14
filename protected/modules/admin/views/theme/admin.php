<ul class="breadcrumb">
    <li>
        <a href="<?php echo Yii::app()->createUrl('admin'); ?>">Панель управления</a> &rarr;
        Темы
    </li>
</ul>
<div class="row">
    <div class="span9">
        <div>
            <div>
                <h2 class="pull-left">Управление темами</h2>
                <a href="<?php echo Yii::app()->createUrl('admin/theme/create'); ?>" class="btn btn-success pull-right" type="submit">Добавить тему</a>
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
                'id_themes:#',
                'name_themes',
                'l_name_themes',
                'ico_themes',
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
            <label style="font-weight: bold;">ID темы:</label>
            <?php echo $form->textField($model, 'id_themes'); ?>

            <label style="font-weight: bold;">Искать в названии:</label>
            <?php echo $form->textField($model, 'name_themes'); ?>

            <?php $this->endWidget(); ?>
        </div>
    </div>
</div>