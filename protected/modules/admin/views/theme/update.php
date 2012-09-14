<ul class="breadcrumb">
    <li>
        <a href="<?php echo Yii::app()->createUrl('admin'); ?>">Панель управления</a> &rarr;
        <a href="<?php echo Yii::app()->createUrl('admin/theme'); ?>">Темы</a> &rarr;
        Редактирование темы
    </li>
</ul>
<div class="row">
    <div class="span9">
        <div>
            <div>
                <h2 class="pull-left">Редактирование темы</h2>
                <a href="<?php echo Yii::app()->createUrl('admin/theme'); ?>" class="btn pull-right" type="submit">
                    Вернуться назад
                </a>
            </div>
            <div style="clear:both;"></div>
            <hr />
            <?php echo $this->renderPartial('_form', array('act' => $act, 'coupons' => $coupons)); ?>
        </div>
    </div>
</div>