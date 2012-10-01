<?php
$CHttpRequest = new CHttpRequest();
?>
<div class="form" style="min-height: 200px">
    <?php if(!$return['insertNewPass']){ ?>
        <?php if(!$return['message']){ ?>
            <?php if(!$return['message']){ ?>
                <div style="color: red;">
                    <?php echo $return['errorMessage']; ?>
                </div>
            <?php } ?>
            <?php echo CHtml::beginForm(); ?>
                <?php echo CHtml::label('Введите e-mail указанный при регистрации', 'email'); ?>
                <?php echo CHtml::textField('email', $CHttpRequest->getParam('email'), array('id'=>'email')) ?>
                <div class="row buttons">
                    <?php echo CHtml::submitButton('Востановить'); ?>
                </div>
            <?php echo CHtml::endForm(); ?>
        <?php } else { ?>
            <div><?php echo $return['message']; ?></div>
        <?php } ?>
    <?php } else { ?>
        <?php if(!$return['recoverySucces']) { ?>
            <?php if($return['errorMessage']){ ?>
                <div style="color: red;">
                    <?php echo $return['errorMessage']; ?>
                </div>
            <?php } ?>
            <?php echo CHtml::beginForm(); ?>
                <?php echo CHtml::label('Введите новый пароль', 'password'); ?>
                <?php echo CHtml::passwordField('password', $CHttpRequest->getParam('password'), array('id'=>'password')) ?>
                <?php echo CHtml::label('Еще раз', 'passwordControl'); ?>
                <?php echo CHtml::passwordField('passwordControl', $CHttpRequest->getParam('passwordControl'), array('id'=>'passwordControl')) ?>
                <div class="row buttons">
                    <?php echo CHtml::submitButton('Сохранить'); ?>
                </div>
            <?php echo CHtml::endForm(); ?>
        <?php } else { ?>
            <div>
                Новый пароль успешно сохранен!
                <a href="/user/login" class="" onclick="show_login(1); return false;"><b>Войти</b></a> на сайт
            </div>
        <?php } ?>
    <?php } ?>
</div>