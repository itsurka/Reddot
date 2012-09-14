<div class="row">
    <div class="span9">
        <div>
            <div>
                <h2>Купленные купоны</h2>
            </div>
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
                    'name' => 'id',
                    'htmlOptions' => array('style' => 'width: 20px;'),
                ),
                array(
                    'name' => 'secret_key',
                    'value' => '"<b>{$data->secret_key}</b>"',
                    'type' => 'raw',
                    'htmlOptions' => array('style' => 'width: 100px;'),
                ),
                //'name_act',
                array(
                    'name' => 'act_search',
                    'value' => 'CHtml::link(strlen($data->coupon->act->name_act) > 70 ? mb_substr($data->coupon->act->name_act, 0, 70,"utf-8") . "..." : $data->coupon->act->name_act, Yii::app()->createUrl("manager/default/view/id/{$data->id}"))',
                    'type' => 'raw',
                ),
                array(
                    'name' => 'Название купона',
                    'value' => '$data->coupon->title',
                    'type' => 'raw',
                ),
                array(
                    'type' => 'raw',
                    'name' => 'coupon.act.photo_act',
                    'value' => '$data->coupon->act->getPictureImageHtmlCode("resized", array("width"=>"20px"))',
                    'htmlOptions' => array('style' => 'width: 50px;text-align:center;'),
                ),
                array
                    (
                    'name' => 'status',
                    'header' => 'Активация',
                    'value' => '$data->status == ' . Purchase::STATUS_ACTIVATED . ' ? "Использован" : CHtml::link("Активация", array("default/activation/id/$data->id"), array("onclick"=>"return confirm(\'Вы уверены, что хотите активировать этот купон?\');"))',
                    'type' => 'raw',
                    'htmlOptions' => array('style' => 'width: 100px;'),
                ),
            ),
        ));
        ?>
    </div>
    <div class="span3" style="margin-top: 100px;">
        <div class="well">
            <?php $form = $this->beginWidget('CActiveForm', array('action' => Yii::app()->createUrl($this->route))); ?>
            <label style="font-weight: bold;">Секретный ключ:</label>
            <?php echo $form->textField($model, 'secret_key'); ?>

            <label style="font-weight: bold;">Искать в названии купона:</label>
            <?php echo $form->textField($model, 'coupon_title_search'); ?>

            <label style="font-weight: bold;">Статус купона:</label>
            <?php echo $form->dropDownList($model, 'status', array('' => '') + $model->statusListData); ?>

            <?php $this->endWidget(); ?>
        </div>
    </div>
</div>