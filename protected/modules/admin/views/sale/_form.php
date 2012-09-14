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
        <?php echo $form->labelEx($model, 'start', array('class' => 'control-label')); ?>
        <div class="controls">
            <?php $this->widget('application.extensions.timepicker.timepicker', array('model' => $model, 'name' => 'start')); ?>
        </div>
    </div>
    <div class="control-group">
        <?php echo $form->labelEx($model, 'finish', array('class' => 'control-label')); ?>
        <div class="controls">
            <?php $this->widget('application.extensions.timepicker.timepicker', array('model' => $model, 'name' => 'finish')); ?>
        </div>
    </div>


    <div class="form-actions">
        <?php echo CHtml::submitButton('Сохранить', array('class' => 'btn btn-primary')); ?>
        <a href="<?php echo Yii::app()->createUrl('admin/sale'); ?>" class="btn">Вернуться назад</a>
    </div>
</fieldset>
<?php $this->endWidget(); ?>