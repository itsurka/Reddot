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
        <?php echo $form->labelEx($model, 'option_id', array('class' => 'control-label')); ?>
        <div class="controls">
            <?php echo $form->dropDownList($model, 'option_id', array('' => '') + CHtml::listData(Option::model()->findAll('type=\'local\''), 'id', 'title'), array('class' => 'input-xlarge')); ?>
        </div>
    </div>

    <div class="control-group">
        <?php echo $form->labelEx($model, 'towns_id', array('class' => 'control-label')); ?>
        <div class="controls">
            <?php if (Yii::app()->user->role == User::ROLE_ADMIN): ?>
                <?php echo $form->dropDownList($model, 'towns_id', array('' => '') + Town::model()->getTownsListData(), array('class' => 'input-xlarge')); ?>
            <?php elseif (Yii::app()->user->role == User::ROLE_LOCALE_ADMIN): ?>
                <?php echo $form->hiddenField($model, 'towns_id', array('value' => Yii::app()->user->getTownId()), array('class' => 'input-xlarge')); ?>
            <?php endif; ?>
        </div>
    </div>

    <div class="control-group">
        <?php echo $form->labelEx($model, 'value', array('class' => 'control-label')); ?>
        <div class="controls">
            <?php echo $form->textField($model, 'value', array('class' => 'input-xlarge')); ?>
        </div>
    </div>

    <div class="form-actions">
        <?php echo CHtml::submitButton('Сохранить', array('class' => 'btn btn-primary')); ?>
        <a href="<?php echo Yii::app()->createUrl('admin/optionValue'); ?>" class="btn">Вернуться назад</a>
    </div>
</fieldset>
<?php $this->endWidget(); ?>