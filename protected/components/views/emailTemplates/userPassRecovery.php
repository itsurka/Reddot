<p style="padding: 0; margin: 21px 0;">
    <div class="title2" style="font-size: 1.1em;">
        <strong>
            Востановление пароля
        </strong>
    </div>
    На сайте <?php echo Option::getByName('company_url'); ?> поступил запрос о востановлении пароля пользователя <?php echo !empty($_user_->first_name) ? $_user_->first_name : $_user_->email; ?><br>
    Для установки нового пароля продите по данной <?php echo $_activationLink_; ?>
</p>

<p style="padding: 0; margin: 21px 0;">
    Проигнориуйте данное сообщение, если Вы не являетесь пользователем данного сайта.
</p>