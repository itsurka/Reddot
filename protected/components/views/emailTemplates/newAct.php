<div class="title">
    Здравствуйте, <?php echo $_mainAdmin_->first_name; ?>!
</div>
<div class="actName">
    На сайте <?php echo Option::getCompanyName(); ?> в <strong>г. <?php echo $_act_->town->name_towns; ?></strong> опубликована новая акция:<br>
    <strong><?php echo $_act_->name_act; ?></strong><br>
    <?php echo $_act_->getUrl(); ?>
</div>
<p>Тип акции: <strong><?php echo $_act_->getStrActType(); ?></strong></p>
<p>Скидка: <strong>-<?php echo $_act_->discount; ?>%</strong></p>
<p>Дата окончании акции: <strong><?php echo date('d.m.Y', strtotime($_act_->date_end_act)); ?></strong></p>
<p>Дата окончании действия купонов: <strong><?php echo date('d.m.Y', strtotime($_act_->date_end_coupon_act)); ?></strong></p>
<p>Кол-во купонов на покупку: <strong><?php echo $_act_->coupon_count; ?></strong></p>
<p>Кол-во ТИПОВ купонов на странице акции: <strong><?php echo count($_act_->coupons); ?></strong></p>
<p>Организация: <strong><?php echo $_act_->user->company_name; ?></strong></p>
<p>
    Отображаемые контакты и адрес организации на сайте:<br>
    <?php
    $addresses = json_decode($_act_->user->address);
    ?>
    <?php foreach($addresses as $address): ?>
        <strong><?php echo $address->address; ?></strong>
    <?php endforeach; ?>
</p>
<br>
<p>
    Условия акции:<br>
    <?php echo $_act_->terms; ?>
</p>