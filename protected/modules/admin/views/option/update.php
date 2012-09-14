<ul class="breadcrumb">
    <li>
        <a href="<?php echo Yii::app()->createUrl('admin'); ?>">Панель управления</a> &rarr;
        <a href="<?php echo Yii::app()->createUrl('admin/option'); ?>">Опции</a> &rarr;
        Редактирование опции
    </li>
</ul>
<div class="row">
    <div class="span9">
        <div>
            <div>
                <h2 class="pull-left">Редактирование опции</h2>
                <a href="<?php echo Yii::app()->createUrl('admin/option'); ?>" class="btn pull-right" type="submit">
                    Вернуться назад
                </a>
            </div>
            <div style="clear:both;"></div>
            <hr />
            <?php echo $this->renderPartial('_form', array('model' => $model)); ?>
        </div>
    </div>
</div>