<?php Yii::app()->clientScript->registerScript('admin/views/page/_form', "
    checkPageType();

    function checkPageType() {
        if($('#Page_type').val() == '" . Page::TYPE_NEW . "') {
            $('#Page_text_area').show();
        }
        else {
            $('#Page_text_area').hide();
        }
    }

    $('select').change(function(){
        checkPageType();
    });
");
?>

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
        <?php echo $form->labelEx($model, 'title', array('class' => 'control-label')); ?>
        <div class="controls">
            <?php echo $form->textField($model, 'title', array('class' => 'input-xlarge')); ?>
        </div>
    </div>

    <div class="control-group">
        <?php echo $form->labelEx($model, 'name', array('class' => 'control-label')); ?>
        <div class="controls">
            <?php echo $form->textField($model, 'name', array('class' => 'input-xlarge')); ?>
        </div>
    </div>

    <div class="control-group">
        <?php echo $form->labelEx($model, 'type', array('class' => 'control-label')); ?>
        <div class="controls">
            <?php echo $form->dropDownList($model, 'type', Page::model()->availableTypes); ?>
        </div>
    </div>

    <div class="control-group" id="Page_text_area">
        <?php echo $form->labelEx($model, 'text', array('class' => 'control-label')); ?>
        <div class="controls">
            <?php echo $form->textArea($model, 'text', array('class' => 'input-xxlarge redactor')); ?>
        </div>
    </div>

    <hr />

    <div class="control-group">
        <?php echo $form->labelEx($model, 'seo_title', array('class' => 'control-label')); ?>
        <div class="controls">
            <?php echo $form->textField($model, 'seo_title', array('class' => 'input-xlarge')); ?>
        </div>
    </div>

    <div class="control-group">
        <?php echo $form->labelEx($model, 'seo_description', array('class' => 'control-label')); ?>
        <div class="controls">
            <?php echo $form->textArea($model, 'seo_description', array('class' => 'input-xxlarge')); ?>
        </div>
    </div>

    <div class="control-group">
        <?php echo $form->labelEx($model, 'seo_keywords', array('class' => 'control-label')); ?>
        <div class="controls">
            <?php echo $form->textArea($model, 'seo_keywords', array('class' => 'input-xxlarge')); ?>
        </div>
    </div>

    <div class="form-actions">
        <?php echo CHtml::submitButton('Сохранить', array('class' => 'btn btn-primary')); ?>
        <a href="<?php echo Yii::app()->createUrl('admin/page'); ?>" class="btn">Вернуться назад</a>
    </div>
</fieldset>
<?php $this->endWidget(); ?>