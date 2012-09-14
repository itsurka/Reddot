<ul class="breadcrumb">
    <li>
        <a href="<?php echo Yii::app()->createUrl('admin'); ?>">Панель управления</a> &rarr;
        Страницы
    </li>
</ul>
<div class="row">
    <div class="span9">
        <div>
            <div>
                <h2 class="pull-left">Управление страницами</h2>
                <a href="<?php echo Yii::app()->createUrl('admin/page/create'); ?>" class="btn btn-success pull-right" type="submit">
                    Добавить страницу
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
                array(
                    'name' => 'title',
                    'htmlOptions' => array(
                        'style' => 'width: 500px;',
                    ),
                ),
                'name',
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
            <label style="font-weight: bold;">ID страницы:</label>
            <?php echo $form->textField($model, 'id'); ?>

            <label style="font-weight: bold;">Искать в названии:</label>
            <?php echo $form->textField($model, 'title'); ?>

            <label style="font-weight: bold;">Искать в ссылке:</label>
            <?php echo $form->textField($model, 'name'); ?>

            <?php $this->endWidget(); ?>
        </div>
    </div>
</div>