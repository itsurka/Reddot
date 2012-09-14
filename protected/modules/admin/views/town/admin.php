<ul class="breadcrumb">
    <li>
        <a href="<?php echo Yii::app()->createUrl('admin'); ?>">Панель управления</a> &rarr;
        Города
    </li>
</ul>
<div class="row">
    <div class="span9">
        <div>
            <div>
                <h2 class="pull-left">Управление городами</h2>
                <a href="<?php echo Yii::app()->createUrl('admin/town/create'); ?>" class="btn btn-success pull-right" type="submit">Добавить город</a>
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
                    'name' => 'id_towns',
                    'header' => '#',
                    'htmlOptions' => array(
                        'style' => 'width: 20px;',
                    ),
                ),
                'name_towns',
                array(
                    'class' => 'CButtonColumn',
                    'template' => '{update}',
                ),
            ),
        ));
        ?>
    </div>
    <div class="span3" style="margin-top: 100px;">
        <div class="well">
            <?php $form = $this->beginWidget('CActiveForm', array('action' => Yii::app()->createUrl($this->route))); ?>
            <label style="font-weight: bold;">ID города:</label>
            <?php echo $form->textField($model, 'id_towns'); ?>

            <label style="font-weight: bold;">Искать в названии:</label>
            <?php echo $form->textField($model, 'name_towns'); ?>

            <?php $this->endWidget(); ?>
        </div>
    </div>
</div>