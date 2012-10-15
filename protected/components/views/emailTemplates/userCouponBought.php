<div class="title" style="margin-bottom: 28px;">
    Здравствуйте<?php echo !empty($_user_->first_name) ? ', '.$_user_->first_name : ''; ?>!<br>
</div>

<p style="padding: 0; margin: 21px 0;">
    <div class="title2" style="font-size: 1.1em;">
        <strong>
            Вами совершена покупка и оплата купонов:
        </strong>
    </div>
</p>

<?php foreach ($_coupons_ as $_purchase_): ?>
    <div class="coupon" style="margin-bottom: 40px;">
        <?php
        $_act_ = Act::model()->findByPk($_purchase_->act_id);
        ?>

        <div class="left-border" style="margin-top: 5px; border-left: 3px solid red; padding-left: 12px;">
            <div class="coupon-title" style="margin-bottom: 10px;">
                <?php echo CHtml::link('text', Option::getWebsiteUrl().'/'.$_act_->short_url, array('style'=>'color: #006FFF; font-weight: bold;')) ?>
            </div>
            <div class="coupon-left" style="float: left; width: 300px;">
                <div class="act-terms" style="color: #555">
                    <?php /*echo strip_tags($_act_->terms); */?>
                    Размер скидки с купоном: <span style="color: red; font-weight: bold;">-<?php echo $_act_->getDiscount(); ?>%</span>
                </div>
                <div class="lines" style="margin-bottom: 3px;">&mdash;&mdash;&mdash;&mdash;&mdash;&mdash;&mdash;&mdash;&mdash;&mdash;&mdash;&mdash;</div>
                <span style="font-weight: bold; font-size: 0.8em;">Код купона:</span><br>
                <div class="coupon-code" style="color: #FF7500; font-size: 2em; margin: 4px 0;">
                    <?php echo $_purchase_->secret_key; ?>
                </div>
                <div class="lines">&mdash;&mdash;&mdash;&mdash;&mdash;&mdash;&mdash;&mdash;&mdash;&mdash;&mdash;&mdash;</div>
            </div>
            <div class="coupon-right" style="float: left; margin-left: 30px;">
                <span style="color: #555">Дата окончания действия купона:</span> <strong><?php echo date('d.m.Y', strtotime($_act_->date_end_coupon_act)); ?></strong><br>
                <span style="color: #555"><strong>Для использования кода в компании можно:</strong></span>
                <ul style=" color: #555; margin-bottom: 10px; margin-top: 10px; padding-left: 10px; list-style-type: none;">
                    <li> - сфотографировать код на телефон</li>
                    <li> - записать на бумаге</li>
                    <li> - распечатать изображение *.jpg в приложении к письму</li>
                </ul>
            </div>
            <div class="clear" style="clear: both;"></div>
        </div>

        <div class="left-border" style="margin-top: 5px; border-left: 3px solid red; padding-left: 12px;">
            <div class="organization-info" style="font-size: 0.9em;">
                <strong>Контакты и адреса организации:</strong><br>
                <?php echo $_act_->user->phone ?><br>
                <?php
                $addresses = json_decode($_act_->user->address);
                ?>
                <?php foreach($addresses as $address): ?>
                    <?php echo $address->address; ?><br>
                <?php endforeach; ?>
                <?php echo CHtml::link($_act_->user->website, Option::getPreparedUrl($_act_->user->website)); ?>
            </div>
        </div>
    </div>
<?php endforeach; ?>