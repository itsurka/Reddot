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
        <?php echo $form->labelEx($model, 'name_towns', array('class' => 'control-label')); ?>
        <div class="controls">
            <?php echo $form->textField($model, 'name_towns', array('class' => 'input-xlarge')); ?>
        </div>
    </div>
    <div class="control-group">
        <?php echo $form->labelEx($model, 'description', array('class' => 'control-label')); ?>
        <div class="controls">
            <?php echo $form->textArea($model, 'description', array('class' => 'input-xxlarge')); ?>
            <p class="help-block">Будет отображаться в подвале сайта</p>
        </div>
    </div>
    <div class="control-group">
        <?php echo $form->labelEx($model, 'email', array('class' => 'control-label')); ?>
        <div class="controls">
            <?php echo $form->textField($model, 'email', array('class' => 'input-xlarge')); ?>
        </div>
    </div>

    <div class="form-actions">
        <?php echo CHtml::submitButton('Сохранить', array('class' => 'btn btn-primary')); ?>
        <a href="<?php echo Yii::app()->createUrl('admin/town'); ?>" class="btn">Вернуться назад</a>
    </div>
</fieldset>
<?php $this->endWidget(); ?>