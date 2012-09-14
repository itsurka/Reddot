<?php Yii::app()->clientScript->registerCssFile(Yii::app()->baseUrl . '/css/form.css'); ?>
<td valign="top">
    <table class="cont_tab" cellpadding="0" cellspacing="0" border="0">
        <tr>
            <td height="50" valign="top">
                <h1 style="margin: 0px 20px;">Обратная связь</h1>
            </td>
        </tr>
        <tr>
            <td class="l_col_headline2" height="1"></td>
        </tr>
        <tr>
            <td style="padding: 20px;">
                <?php if (Yii::app()->user->hasFlash('mailSended')): ?>
                    <div class="flash-success">
                        <?php echo Yii::app()->user->getFlash('mailSended'); ?>
                    </div>
                <?php else: ?>
                    <div class="form">
                        <?php
                        $form = $this->beginWidget('CActiveForm', array(
                            'id' => 'contact-form',
                            'enableClientValidation' => true,
                            'clientOptions' => array(
                                'validateOnSubmit' => true,
                                'validateOnChange' => true,
                            ),
                        ));
                        ?>

                        <?php echo $form->errorSummary($model); ?>

                        <div class="row">
                            <?php echo $form->labelEx($model, 'name'); ?>
                            <?php echo $form->textField($model, 'name'); ?>
                            <?php echo $form->error($model, 'name'); ?>
                        </div>

                        <div class="row">
                            <?php echo $form->labelEx($model, 'email'); ?>
                            <?php echo $form->textField($model, 'email'); ?>
                            <?php echo $form->error($model, 'email'); ?>
                        </div>

                        <div class="row">
                            <?php echo $form->labelEx($model, 'subject'); ?>
                            <?php echo $form->textField($model, 'subject'); ?>
                            <?php echo $form->error($model, 'subject'); ?>
                        </div>

                        <div class="row">
                            <?php echo $form->labelEx($model, 'body'); ?>
                            <?php echo $form->textArea($model, 'body', array('rows' => 6, 'cols' => 50)); ?>
                            <?php echo $form->error($model, 'body'); ?>
                        </div>

                        <?php if (CCaptcha::checkRequirements()): ?>
                            <div class="row">
                                <?php echo $form->labelEx($model, 'verifyCode'); ?>
                                <div>
                                    <?php echo $form->textField($model, 'verifyCode', array('style' => 'top: -18px;position:relative;')); ?>
                                    <?php $this->widget('CCaptcha', array('clickableImage' => true, 'showRefreshButton' => false)); ?>
                                </div>
                                <?php echo $form->error($model, 'verifyCode'); ?>
                            </div>
                        <?php endif; ?>
                        <div class="row buttons">
                            <?php echo CHtml::submitButton('Submit'); ?>
                        </div>
                        <?php $this->endWidget(); ?>
                    </div><!-- form -->
                <?php endif; ?>
            </td>
        </tr>
    </table>
</td>