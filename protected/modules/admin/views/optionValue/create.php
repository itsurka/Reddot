<ul class="breadcrumb">
    <li>
        <a href="<?php echo Yii::app()->createUrl('admin'); ?>">Панель управления</a> &rarr;
        <a href="<?php echo Yii::app()->createUrl('admin/optionValue'); ?>">Редактирование опций</a> &rarr;
        Добавить новое значение
    </li>
</ul>
<div class="row">
    <div class="span9">
        <div>
            <div>
                <h2 class="pull-left">Добавить новое значение</h2>
                <a href="<?php echo Yii::app()->createUrl('admin/optionValue'); ?>" class="btn pull-right" type="submit">
                    Вернуться назад
                </a>
            </div>
            <div style="clear:both;"></div>
            <hr />
            <?php echo $this->renderPartial('_form', array('model' => $model)); ?>
        </div>
    </div>
</div>