<ul class="breadcrumb">
    <li>
        <a href="<?php echo Yii::app()->createUrl('admin'); ?>">Панель управления</a> &rarr;
        Пользователи
    </li>
</ul>
<div class="row">
    <div class="span9">
        <div>
            <div>
                <h2 class="pull-left">Управление пользователями</h2>
                <a href="<?php echo Yii::app()->createUrl('admin/user/create'); ?>" class="btn btn-success pull-right" type="submit">Добавить пользователя</a>
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
                'username',
                array(
                    'name' => 'role',
                    'value' => 'User::model()->roleListData[$data->role]',
                ),
                array(
                    'name' => 'createtime',
                    'value' => 'Yii::app()->dateFormatter->format("dd MMM yyyy", $data->createtime)',
                ),
                array
                    (
                    'name' => 'id_towns_user',
                    'value' => 'isset($data->town->name_towns) ? $data->town->name_towns : "Не указан"',
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
            <label style="font-weight: bold;">ID пользователя:</label>
            <?php echo $form->textField($model, 'id'); ?>

            <label style="font-weight: bold;">Искать в имени:</label>
            <?php echo $form->textField($model, 'username'); ?>

            <label style="font-weight: bold;">Группа:</label>
            <?php echo $form->dropDownList($model, 'role', array('' => 'Любая группа') + User::getRoles()); ?>

            <label style="font-weight: bold;">Город:</label>
            <?php echo $form->dropDownList($model, 'id_towns_user', array('' => 'Любой город') + Town::model()->getTownsListData()); ?>

            <label style="font-weight: bold;">Дополнительные опции:</label>
            <label class="checkbox">
                <?php echo $form->checkBox($model, 'active'); ?> Активен
            </label>
            <?php $this->endWidget(); ?>
        </div>
    </div>
</div>