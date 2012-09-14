<?php
$form = $this->beginWidget('CActiveForm', array(
    'id' => 'town-form',
    'enableAjaxValidation' => false,
    'htmlOptions' => array(
        'enctype' => 'multipart/form-data',
        'autocomplete' => 'off',
        'class' => 'form-horizontal',
    )
));
?>

<fieldset>
    <?php if ($model->hasErrors()): ?>
        <div class="alert alert-error">
            <?php echo CHtml::errorSummary(array($model)); ?>
        </div>
    <?php endif; ?>
    <div class="control-group">
        <?php echo $form->labelEx($model, 'name', array('class' => 'control-label')); ?>
        <div class="controls">
            <?php echo $form->textField($model, 'name', array('class' => 'input-xlarge')); ?>
        </div>
    </div>
    <div class="control-group">
        <?php echo $form->labelEx($model, 'title', array('class' => 'control-label')); ?>
        <div class="controls">
            <?php echo $form->textField($model, 'title', array('class' => 'input-xlarge')); ?>
        </div>
    </div>    <div class="control-group">
        <?php echo $form->labelEx($model, 'default_value', array('class' => 'control-label')); ?>
        <div class="controls">
            <?php echo $form->textField($model, 'default_value', array('class' => 'input-xlarge')); ?>
        </div>
    </div>

    <div class="control-group">
        <?php echo $form->labelEx($model, 'type', array('class' => 'control-label')); ?>
        <div class="controls">
            <?php echo $form->dropDownList($model, 'type', array('global' => 'Глобальная', 'local' => 'Локальная'), array('class' => 'input-xlarge')); ?>
        </div>
    </div>

    <div class="form-actions">
        <?php echo CHtml::submitButton('Сохранить', array('class' => 'btn btn-primary')); ?>
        <a href="<?php echo Yii::app()->createUrl('admin/option'); ?>" class="btn">Вернуться назад</a>
    </div>
</fieldset>
<?php $this->endWidget(); ?>