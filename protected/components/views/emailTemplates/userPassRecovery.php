<p>
    <div class="title2">
        <strong>
            Востановление пароля
        </strong>
    </div>
    На сайте <?php echo Option::getByName('company_url'); ?> поступил запрос о востановлении пароля пользователя <?php echo !empty($_user_->first_name) ? $_user_->first_name : $_user_->email; ?><br>
    Для установки нового пароля продите по данной <?php echo $_activationLink_; ?>
</p>

<p>
    Проигнориуйте данное сообщение, если Вы не являетесь пользователем данного сайта.
</p>