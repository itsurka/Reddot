<div class="title" style="margin-bottom: 28px">
    Здравствуйте<?php echo !empty($_user_->first_name) ? ', '.$_user_->first_name : ''; ?>!<br>
    Вы зарегистрированы на сайте <?php echo Option::getWebsiteLink(); ?>
</div>

<p style="padding: 0; margin: 21px 0;">
    <div class="title2" style="font-size: 1.1em;">
        <strong>
            Данные для входа в систему
        </strong>
    </div>
    Логин: <?php echo $_user_->email; ?><?php echo !empty($_user_->username) ? '-'.$_user_->username : ''; ?><br>
    Пароль: <?php echo $_password_; ?>
</p>

<p style="padding: 0; margin: 21px 0;">
    <div class="title2" style="font-size: 1.1em;">
        <strong>
            Смена пароля
        </strong>
    </div>
    Для смены пароля используйте вкладку <?php echo CHtml::link('Управление аккаунтом', Option::getWebsiteUrl() . '/user/update') ?> раздела "Личный кабинет"
</p>

<p style="padding: 0; margin: 21px 0;">
    <div class="title2" style="font-size: 1.1em;">
        <strong>
            Как пользоваться сервисом?
        </strong>
    </div>
    Ознакомьтесь с <?php echo CHtml::link('инструкцией', Option::getWebsiteUrl() . '/instruction') ?> сервиса для покупки и оплаты купонов, а также их использованию
</p>