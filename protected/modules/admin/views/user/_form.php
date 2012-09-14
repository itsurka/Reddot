<?php
Yii::app()->clientScript->registerScript('user/create', "
    function checkRole() {
        if($('#User_role').val() == '" . User::ROLE_ORG . "') {
            $('#organisationFields').fadeIn(200);
        }
        else {
            $('#organisationFields').fadeOut(200);
        }
    }

    checkRole();

    $('.addItem').live('click', function(){
        if($('#addressList div').length < 10) {
            $('#addressList').append($('#itemTpl').html());
        }

        return false;
    });

    $('.removeItem').live('click', function() {
        var items = $('#addressList input');
        if(items.length > 1) {
            $(this).parent().remove();
        }

        return false;
    });
    
    $('#User_role').change(function() {
        checkRole();
    });
");

$form = $this->beginWidget('CActiveForm', array(
    'id' => 'user-form',
    'enableAjaxValidation' => false,
    'htmlOptions' => array(
        'enctype' => 'multipart/form-data',
        'autocomplete' => 'off',
        'class' => 'form-horizontal',
    )
        ));
?>
<script type="text/plain" id="itemTpl">
    <div>
        <input type="text" class="input-xlarge" name="User[addressList][][address]" size="40" />
        <a href="#" class="addressItemAction removeItem">удалить</a>
    </div>
</script>
<fieldset>
    <?php if ($model->hasErrors()): ?>
        <div class="alert alert-error">
            <?php echo CHtml::errorSummary(array($model)); ?>
        </div>
    <?php endif; ?>

    <div class="control-group">
        <?php echo $form->labelEx($model, 'role', array('class' => 'control-label')); ?>
        <div class="controls">
            <?php echo $form->dropDownList($model, 'role', User::getRoles()); ?>
        </div>
    </div>

    <div class="control-group">
        <?php echo $form->labelEx($model, 'active', array('class' => 'control-label')); ?>
        <div class="controls">
            <?php echo $form->dropDownList($model, 'active', User::getActiveSet()); ?>
        </div>
    </div>

    <div class="control-group">
        <?php echo $form->labelEx($model, 'username', array('class' => 'control-label')); ?>
        <div class="controls">
            <?php echo $form->textField($model, 'username', array('class' => 'input-xlarge')); ?>
        </div>
    </div>

    <div class="control-group">
        <?php echo $form->labelEx($model, 'email', array('class' => 'control-label')); ?>
        <div class="controls">
            <?php echo $form->textField($model, 'email', array('class' => 'input-xlarge')); ?>
        </div>
    </div>

    <div class="control-group">
        <?php echo $form->labelEx($model, 'password', array('class' => 'control-label')); ?>
        <div class="controls">
            <?php echo $form->passwordField($model, 'password', array('class' => 'input-xlarge')); ?>
        </div>
    </div>

    <div class="control-group">
        <?php echo $form->labelEx($model, 'password2', array('class' => 'control-label')); ?>
        <div class="controls">
            <?php echo $form->passwordField($model, 'password2', array('class' => 'input-xlarge')); ?>
        </div>
    </div>

    <div class="control-group">
        <?php echo $form->labelEx($model, 'avatar', array('class' => 'control-label')); ?>
        <div class="controls">
            <?php echo $form->fileField($model, 'avatar', array('class' => 'input-xlarge')); ?>
        </div>
    </div>

    <div class="control-group">
        <div class="controls">
            <label class="checkbox">
                <?php echo $form->checkBox($model, 'delete_avatar'); ?>
                Удалить фотографию пользователя?
            </label>
        </div>
    </div>

    <div style="display:none;" id="organisationFields">
        <h4>Контактная информация организации</h4>
        <hr />
        <div class="control-group">
            <?php echo $form->labelEx($model, 'company_name', array('class' => 'control-label')); ?>
            <div class="controls">
                <?php echo $form->textField($model, 'company_name', array('class' => 'input-xlarge')); ?>
            </div>
        </div>

        <div class="control-group">
            <?php echo $form->labelEx($model, 'phone', array('class' => 'control-label')); ?>
            <div class="controls">
                <?php echo $form->textField($model, 'phone', array('class' => 'input-xlarge')); ?>
            </div>
        </div>

        <div class="control-group">
            <?php echo $form->labelEx($model, 'working_time', array('class' => 'control-label')); ?>
            <div class="controls">
                <?php echo $form->textArea($model, 'working_time', array('class' => 'input-xlarge')); ?>
            </div>
        </div> 

        <div class="control-group">
            <?php echo $form->labelEx($model, 'website', array('class' => 'control-label')); ?>
            <div class="controls">
                <?php echo $form->textField($model, 'website', array('class' => 'input-xlarge')); ?>
            </div>
        </div>
        <div class="control-group">
            <div class="controls">
                <a href="#" class="addressItemAction addItem"><i class="icon-plus-sign"></i> добавить адрес</a>
            </div>
        </div>
        <div class="control-group">
            <?php echo $form->labelEx($model, 'addressList', array('class' => 'control-label')); ?>
            <div class="controls" id="addressList">
                <?php if (count($model->getAddressListArray())): ?>
                    <?php foreach ($model->getAddressListArray() as $item): ?>
                        <div>
                            <input type="text" class="input-xlarge" value="<?php echo $item['address']; ?>" size="40" name="User[addressList][][address]" />
                            <a href="#" class="addressItemAction removeItem">удалить</a>
                        </div>
                    <?php endforeach; ?>
                <?php else: ?>
                    <div>
                        <input type="text" class="input-xlarge" name="User[addressList][][address]" size="40" />
                        <p class="help-block">Например  &mdash; г. Москва, ул. Ленина, д. 22</p>
                    </div>
                <?php endif; ?>
            </div>
        </div>
    </div>

    <div class="form-actions">
        <?php echo CHtml::submitButton('Сохранить', array('class' => 'btn btn-primary')); ?>
        <a href="<?php echo Yii::app()->createUrl('admin/user'); ?>" class="btn">Вернуться назад</a>
    </div>

</fieldset>
<?php $this->endWidget(); ?>