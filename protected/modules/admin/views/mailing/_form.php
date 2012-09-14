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
        <?php echo $form->labelEx($model, 'subject', array('class' => 'control-label')); ?>
        <div class="controls">
            <?php echo $form->textField($model, 'subject', array('class' => 'input-xlarge')); ?>
        </div>
    </div>

    <div class="control-group">
        <?php echo $form->labelEx($model, 'type', array('class' => 'control-label')); ?>
        <div class="controls">
            <?php echo $form->dropDownList($model, 'type', array('' => '') + Mailing::model()->typesListData, array('class' => 'input-xlarge')); ?>
        </div>
    </div>

    <div class="control-group">
        <?php echo $form->labelEx($model, 'town_id', array('class' => 'control-label')); ?>
        <div class="controls">
            <?php echo $form->dropDownList($model, 'town_id', array('' => '') + Town::model()->getTownsListData(), array('class' => 'input-xlarge')); ?>
        </div>
    </div>

    <div class="control-group">
        <?php echo $form->labelEx($model, 'body', array('class' => 'control-label')); ?>
        <div class="controls">
            <?php echo $form->textArea($model, 'body', array('class' => 'input-xxlarge redactor')); ?>
        </div>
    </div>

    <div class="form-actions">
        <?php echo CHtml::submitButton('Сохранить', array('class' => 'btn btn-primary')); ?>
        <a href="<?php echo Yii::app()->createUrl('admin/mailing'); ?>" class="btn">Вернуться назад</a>
    </div>
</fieldset>
<?php $this->endWidget(); ?>