<?php Yii::app()->clientScript->registerCssFile(Yii::app()->baseUrl . '/css/form.css'); ?>
<td valign="top">
    <table class="cont_tab" cellpadding="0" cellspacing="0" border="0">
        <tr>
            <td>
                <div class="form">

                    <?php echo CHtml::errorSummary($model); ?>

                    <?php
                    $form = $this->beginWidget('CActiveForm', array(
                        'htmlOptions' => array('autocomplete' => 'off'),
                        'focus' => array($model, 'email'),
                    ));
                    ?>
                    <div class="row">
                        <?php echo $form->labelEx($model, 'email'); ?>
                        <?php echo $form->textField($model, 'email'); ?>
                    </div>
                    <div class="row">
                        <?php echo $form->labelEx($model, 'password'); ?>
                        <?php echo $form->passwordField($model, 'password'); ?>
                    </div>
                    <div class="row">
                        <?php echo $form->labelEx($model, 'id_towns_user'); ?>
                        <?php echo $form->dropDownList($model, 'id_towns_user', Town::model()->townListData); ?>
                    </div>
                    <div class="row buttons">
                        <?php echo CHtml::submitButton('Войти'); ?>
                    </div>
                    <?php $this->endWidget(); ?>
                </div>
            </td>
        </tr>
    </table>
</td>