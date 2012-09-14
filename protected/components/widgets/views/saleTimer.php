<?php Yii::app()->clientScript->registerScript('widgets/views/saleTime', "
    var fadeSubscribeBonusSpeed = 200;

    function getIsBonusSubscribed() {
        return $('.mail_nap_tab2').find('.bunusSubscribeArea:visible').is('#bonusIsSubscribed');
    }

    function changeSubscribeTimerArea() {
        var isSubscribed = getIsBonusSubscribed();
        if(isSubscribed) {
            $('#bonusIsSubscribed').fadeOut(fadeSubscribeBonusSpeed, function() {
                $('#bonusIsNotSubscribed').fadeIn(fadeSubscribeBonusSpeed);
            });
        }
        else {
            $('#bonusIsNotSubscribed').fadeOut(fadeSubscribeBonusSpeed, function() {
                $('#bonusIsSubscribed').fadeIn(fadeSubscribeBonusSpeed);
            });            
        }
    }

    function close_kupon_timer_email() {
        $('#kupon_timer_email').hide();
        $('#fade').remove();
        changeSubscribeTimerArea();
    }

    function show_kupon_timer_email() {
        $('body').append('<div id=\'fade\'></div>');
        body_height = document.documentElement.scrollHeight;
        $('body #fade').css('height', body_height);
        $('#kupon_timer_email').center();
        if ($.browser.msie) {
            $('body #fade').fadeTo(300, 0.4, function() {
                $('#kupon_timer_email').show();
            });
        } else {
            $('body #fade').fadeTo(300, 0.4);
            $('#kupon_timer_email').fadeTo(300, 1);
        }

        $('#fade').click(close_kupon_timer_email);
    }

    $('#bonusSubscribeSubmit').click(function(){
        var email = $('#bonusSubscribeEmail').val();
        $.ajax({
            url: '" . Yii::app()->createUrl('/acts/subscribeBonus') . "',
            type: 'POST',
            data: {
                'SaleSubscribe[email]': email,
            },
            complete: function(response) {
                if(response.status == 200) {
                    close_kupon_timer_email();
                }
                else
                    console.log(response);
            }
        });

        return false;
    });

    $('.mail_nap_tab2').click(function() {
        var isSubscribed = getIsBonusSubscribed();

        if(isSubscribed) {
            $.ajax({
                url: '" . Yii::app()->createUrl('/acts/unSubscribeBonus') . "',
                type: 'POST',
                complete: function(response) {
                    if(response.status == 200) {
                        changeSubscribeTimerArea();
                        console.log(response.responseText);
                    }
                    else
                        console.log(response);
                }
            });
        }
        else {
            show_kupon_timer_email();
        }

        return false;
    });
") ?>

<table cellpadding="0" cellspacing="0" border="0" align="center">
    <tr>
        <?php if ($this->lastSale): ?>
            <td width="230" align="center" valign="top">
                Супер распродажа акций через
            </td>
            <td valign="top">
                <a class="mail_nap_tab2" href="#">
                    <div style="text-align: center;padding-top: 4px;">
                        <?php foreach ($this->lastSale->getTimeLeft() as $i => $time): ?>
                            <b class="" style="margin-right: 5px;">
                                <?php echo $time; ?>
                            </b>
                        <?php endforeach; ?>
                    </div>
                    <div class="mail_nap_n3 mail_nap_marg" style="padding-top: 4px;">
                        <div class="mail_nap_n3_a" style="text-align:center;">
                            <div style="<?php echo SaleSubscribe::model()->isSubscribed() ? null : 'display:none;'; ?>" class="bunusSubscribeArea" id="bonusIsSubscribed">
                                <div class="ico_mail_nap2" style="margin-right: 10px;"></div>
                                <div class="mail_nap_n3_2" style="width: 120px;"><span>Отменить подписку</span></div>
                            </div>
                            <div style="<?php echo SaleSubscribe::model()->isSubscribed() ? 'display:none;' : null; ?>" class="bunusSubscribeArea" id="bonusIsNotSubscribed">
                                <div class="ico_mail_nap2"></div>
                                <div class="mail_nap_n3_1" style="width: 60px;">Напомнить</div>
                                <div class="mail_nap_n3_2" style="width: 70px;"><span>по почте</span></div>
                            </div>
                        </div>
                    </div>
                </a>
            </td>
        <?php endif; ?>
    </tr>
</table>