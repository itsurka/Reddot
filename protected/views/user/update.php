<?php
/**
 * Профиль пользователя
 * @author Nikolay Ermin <nikolay@ermin.ru>
 * @link   http://siteforever.ru
 */
/** @var $model User */
?>

<tr>
    <td valign="top">
        <div class="form">

            <?php if ($save) : ?>
                <div class="errorSummary">
                    Данные успешно сохранены
                </div>
            <?php endif; ?>

            <?php
            /** @var $form CActiveForm */
            $form = $this->beginWidget('CActiveForm', array(
                'id' => 'user-profile',
//                'enableClientValidation'=>true,
                'enableAjaxValidation' => true,
                'clientOptions' => array(
                    'validateOnSubmit' => true,
                ),
            ));
            ?>

            <fieldset>
                <legend>Данные для входа</legend>
                <div class="row">
                    <?php echo $form->labelEx($model, 'email'); ?>
                    <?php echo $form->textField($model, 'email'); ?>
                    <?php echo $form->error($model, 'email'); ?>
                </div>

                <div class="row">
                    <?php echo $form->labelEx($model, 'password'); ?>
                    <?php echo $form->passwordField($model, 'password', array('value' => '')); ?>
                    <div class="hint">Укажите, чтобы изменить</div>
                    <?php echo $form->error($model, 'password'); ?>
                </div>

                <?php /* <div class="row">
                  <?php echo $form->labelEx($model,'password2'); ?>
                  <?php echo $form->passwordField($model,'password2',array('value'=>'')); ?>
                  <?php echo $form->error($model,'password2'); ?>
                  </div> */ ?>
            </fieldset>

            <fieldset>
                <legend>Подписка</legend>
                <div class="row checkbox">
                    <?php echo $form->checkBox($model, 'subscribe') ?>
                    <?php echo $form->label($model, 'subscribe') ?>
                    <?php echo $form->error($model, 'subscribe') ?>
                </div>
            </fieldset>

            <fieldset>
                <legend>Личные данные</legend>

                <div class="row">
                    <?php echo $form->labelEx($model, 'first_name'); ?>
                    <?php echo $form->textField($model, 'first_name'); ?>
                    <?php echo $form->error($model, 'first_name'); ?>
                </div>

                <div class="row">
                    <?php echo $form->labelEx($model, 'last_name'); ?>
                    <?php echo $form->textField($model, 'last_name'); ?>
                    <?php echo $form->error($model, 'last_name'); ?>
                </div>

                <div class="row">
                    <?php echo $form->labelEx($model, 'phone'); ?>
                    <?php echo $form->textField($model, 'phone'); ?>
                    <div class="hint">Формат: +7 900 123-45-67</div>
                    <?php echo $form->error($model, 'phone'); ?>
                </div>

                <?php
                $towns = Town::model()->findAll();
                $townsList = array(0 => 'Не выбран');
                foreach ($towns as $town) {
                    $townsList[$town->id_towns] = $town->name_towns;
                }
                ?>

                <div class="row">
                    <?php echo $form->labelEx($model, 'id_towns_user'); ?>
                    <?php echo $form->dropDownList($model, 'id_towns_user', $townsList); ?>
                    <?php echo $form->error($model, 'id_towns_user'); ?>
                </div>

                <div class="row">
                    <?php echo $form->labelEx($model, 'avatar'); ?>
                    <?php echo $form->fileField($model, 'avatar'); ?>
                    <?php echo $form->error($model, 'avatar'); ?>
                </div>

            </fieldset>

            <?php if (User::ROLE_ORG == $model->role) : ?>
                <fieldset>
                    <legend>Данные компании</legend>

                    <div class="row">
                        <?php echo $form->labelEx($model, 'company_name'); ?>
                        <?php echo $form->textField($model, 'company_name'); ?>
                        <?php echo $form->error($model, 'company_name'); ?>
                    </div>

                    <div class="row">
                        <?php echo $form->labelEx($model, 'website'); ?>
                        <?php echo $form->textField($model, 'website'); ?>
                        <div class="hint">Формат: http://example.com</div>
                        <?php echo $form->error($model, 'website'); ?>
                    </div>

                    <div class="row">
                        <?php echo $form->labelEx($model, 'working_time'); ?>
                        <?php echo $form->textArea($model, 'working_time'); ?>
                        <?php echo $form->error($model, 'working_time'); ?>
                    </div>
                    <?php
                    /** @var $address UsersAddress */
                    foreach ($model->address as $address) :
                        ?>
                        <div class="row">
                            <?php echo $form->labelEx($address, 'address'); ?>
                            <?php echo $form->textArea($address, 'address', array('name' => "UsersAddress[address][{$address->id}]")); ?>
                            <?php echo $form->error($address, 'address'); ?>
                        </div>
                    <?php endforeach; ?>

                    <div class="hint">
                        Чтобы удалить адрес, сотрите его содержимое
                    </div>

                    <div class="row">
                        <?php $address = new UsersAddress() ?>
                        <?php echo $form->labelEx($address, 'address'); ?>
                        <?php echo $form->textArea($address, 'address', array('name' => 'UsersAddress[address][0]')); ?>
                        <?php echo $form->error($address, 'address'); ?>
                    </div>

                </fieldset>

            <?php endif; ?>

            <div class="row buttons">
                <?php echo CHtml::submitButton('Сохранить'); ?>
            </div>

            <?php $this->endWidget(); ?>
        </div>
    </td>
</tr>