<?php if ($this->lastSale): ?>
    <div id="kupon_timer_email">
        <form name="kupon_timer_email" enctype="text/plain" method="POST">
            <div class="inner_bl">
                <div class="input_div">
                    <input id="bonusSubscribeEmail" onfocus="$(this).addClass('act');if(this.value=='Введите ваш е-мейл адрес'){this.value='';}" onblur="$(this).removeClass('act');if(this.value==''){this.value='Введите ваш е-мейл адрес';}" name="SaleSubscribe[email]" type="text" value="Введите ваш е-мейл адрес" maxlength="255">
                    <input type="hidden" value="<?php $this->lastSale->id ?>" name="" />
                </div>
                <button class="butt_lnk" id="bonusSubscribeSubmit" type="submit" value="&nbsp;">
                    <div></div>
                    <span>подписаться</span>
                </button>
            </div>
        </form>
    </div>
<?php endif; ?>