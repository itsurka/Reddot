<div class="title">
    Здравствуйте<?php echo !empty($_user_->first_name) ? ', '.$_user_->first_name : ''; ?>!<br>
    Вы зарегистрированы на сайте <?php echo Option::getWebsiteLink(); ?>
</div>

<p>
    <div class="title2">
        <strong>
            Данные для входа в систему
        </strong>
    </div>
    Логин: <?php echo $_user_->email; ?><?php echo !empty($_user_->username) ? '-'.$_user_->username : ''; ?><br>
    Пароль: <?php echo $_password_; ?>
</p>

<p>
    <div class="title2">
        <strong>
            Смена пароля
        </strong>
    </div>
    Для смены пароля используйте вкладку <?php echo CHtml::link('Управление аккаунтом', Option::getWebsiteUrl() . '/user/update') ?> раздела "Личный кабинет"
</p>

<p>
    <div class="title2">
        <strong>
            Как пользоваться сервисом?
        </strong>
    </div>
    Ознакомьтесь с <?php echo CHtml::link('инструкцией', Option::getWebsiteUrl() . '/instruction') ?> сервиса для покупки и оплаты купонов, а также их использованию
</p>