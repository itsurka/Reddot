<ul class="breadcrumb">
    <li>
        <a href="<?php echo Yii::app()->createUrl('admin'); ?>">Панель управления</a> &rarr;
        <a href="<?php echo Yii::app()->createUrl('admin/user'); ?>">Пользователи</a> &rarr;
        Добавить пользователя
    </li>
</ul>
<div class="row">
    <div class="span9">
        <div>
            <div>
                <h2 class="pull-left">Добавить пользователя</h2>
                <a href="<?php echo Yii::app()->createUrl('admin/user'); ?>" class="btn pull-right" type="submit">
                    Вернуться назад
                </a>
            </div>
            <div style="clear:both;"></div>
            <hr />
            <?php echo $this->renderPartial('_form', array('model' => $model)); ?>
        </div>
    </div>
</div>