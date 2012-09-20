<ul class="breadcrumb">
    <li>
        <a href="<?php echo Yii::app()->createUrl('admin'); ?>">Панель управления</a> &rarr;
        Акции
    </li>
</ul>
<div class="row">
    <div class="span9">
        <div>
            <div>
                <h2 class="pull-left">Управление акциями</h2>
                <a href="<?php echo Yii::app()->createUrl('admin/act/create'); ?>" class="btn btn-success pull-right" type="submit">Добавить акцию</a>
            </div>
            <div style="clear:both;"></div>
            <hr />
        </div>
        <?php
        $this->widget('zii.widgets.grid.CGridView', array(
            'id' => 'grid',
            'dataProvider' => $model->adminSearch(),
            'itemsCssClass' => 'table table-striped',
            'summaryText' => '',
            'columns' => array(
                'id_act:#',
                array(
                    'name' => 'name_act',
                    'value' => '$data->name_act',
                ),
                array(
                    'type' => 'raw',
                    'name' => 'photo_act',
                    'value' => '$data->getPictureImageHtmlCode("resized", array("width"=>"20px"))',
                    'htmlOptions' => array(
                        'style' => 'width: 50px;text-align:center;',
                    ),
                ),
                array
                    (
                    'name' => 'id_org_act',
                    'value' => '$data->user->company_name',
                ),
                array
                    (
                    'name' => 'id_town_act',
                    'value' => '$data->town->name_towns',
                ),
                array(
                    'class' => 'CButtonColumn',
                    'template' => '{update}',
                ),
                array(
                    'type' => 'raw',
                    'value' => 'CHtml::link("", "#", array("onclick"=>"cloneAct($data->id);", "class"=>"clone_btn", "title"=>"Клонировать"));',
                ),
            ),
        ));
        ?>
    </div>
    <div class="span3" style="margin-top: 100px;">
        <div class="well">
            <?php $form = $this->beginWidget('CActiveForm', array('action' => Yii::app()->createUrl($this->route))); ?>
            <label style="font-weight: bold;">ID акции:</label>
            <?php echo $form->textField($model, 'id_act'); ?>

            <label style="font-weight: bold;">Искать в названии:</label>
            <?php echo $form->textField($model, 'name_act'); ?>

            <label style="font-weight: bold;">Организация:</label>
            <?php echo $form->textField($model, 'orgNameSearch'); ?>

            <label style="font-weight: bold;">Город:</label>
            <?php echo $form->dropDownList($model, 'id_town_act', array('' => '') + Town::model()->getTownsListData()); ?>

            <label style="font-weight: bold;">Дополнительные опции:</label>
            <label><?php echo $form->checkBox($model, 'is_bonus'); ?> Только бонусные акции</label>

            <?php $this->endWidget(); ?>
        </div>
    </div>
</div>
<style type="text/css">
    a.clone_btn{
        background: url("/images/ico_prof_popoln_plus.png") top center no-repeat;
        display: inline-block;
        width: 10px;
        height: 10px;
    }
</style>
<script type="text/javascript">
    function cloneAct(actID) {
        $.ajax({
            url: '/admin/act/clone/id/' + actID,
            type: 'POST',
            success: function() {
                $('#grid').yiiGridView.update('grid');
            }
        });

    }
</script>