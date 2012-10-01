<?php
Yii::app()->clientScript->registerScript('user/profile', "
    var params = {};
    var actionId = '" . $this->action->id . "';
    
    function show_prof_pop_win_email() {
        $('.send_email_div').fadeIn('slow');
    }

    function close_prof_pop_win_email() {
        $('.send_email_div').fadeOut('slow');
    }

    function send_prof_pop_win_email() {
        var email = $('#sendCouponToEmail').val();
        var couponId = $('#sendCouponToEmail').attr('couponId');
        $.ajax({
            url: '" . Yii::app()->createUrl('/user/ajaxSendCoupon') . "',
            type: 'POST',
            data: {
                'couponId': couponId,
                'email': email,
            },
            complete: function(response) {
                if(response.status == 200) {
                    $('#sendCouponToEmail').val('');
                    close_prof_pop_win_email();
                }
                else {
                    console.log(response.responseText);
                }
            }
        });
    }

    setParams();
    checkPurchaseHash();
    
    $('.prof_kupon_el_title a, .purchaseLinks').click(function(){
        setParams($(this).attr('href'));
        window.location = '" . Yii::app()->createUrl('/user/profile') . "' + '#!' + URL.serialize(params);
        return false;
    });

    function setParams(url) {
        if(!url) {
            var hash = window.location.hash.replace('#!', '?');
            if(!hash)
                return;

            url = hash;
        }

        params = array_merge(params, URL.parse(url).params);
    }

    $(window).bind('hashchange', function() {
        checkPurchaseHash();
    });

    function checkPurchaseHash() {
        if(!params.status && actionId == 'profile') {
            showPurchaseContent($('.prof_kupon_el:first a'));
            $('.purchaseLinks:first').addClass('active');
        }
        else {
            var purchaseItems = $('.prof_kupon_el a');
            for(var i = 0; i < purchaseItems.length; i++) {
                if($(purchaseItems[i]).attr('purchaseType') == params.status) {
                    showPurchaseContent(purchaseItems[i]);
                }
            }
        }
    }

    function showPurchaseContent(el) {
        var purchaseLinks = $('.purchaseLinks');
        $(purchaseLinks).removeClass('active');
        $(purchaseLinks).each(function() {
            if($(this).attr('purchaseLinksType') == params.status) {
                $(this).addClass('active');
            }
        });

        var purchaseItems = $('.prof_kupon_el');
        var purchaseArea = $(el).parent().parent().parent();
        var purchaseType = $(el).attr('purchaseType');

        for(var i = 0; i < purchaseItems.length; i++) {
            if($(purchaseItems[i]).hasClass('active')) {
                $(purchaseItems[i]).find('.slide').slideUp('fast');
                $(purchaseItems[i]).removeClass('active');
            }
        }

        $.ajax({
            data: params,
            complete: function(response) {
                if(response.status == 200) {
                    $(purchaseArea).find('.slide').html(response.responseText);
                    $(purchaseArea).find('.slide').slideDown('fast', function() {
                        $(purchaseArea).addClass('active');
                    });
                }
                else
                    console.log(response);
            }
        });
    }
    
    $('.kod_link').live('click', function() {
        var thisLink = $(this);
        if($(thisLink).hasClass('loadingLink')){
            return false;
        }

        var couponId = $(thisLink).attr('couponId');
        $(thisLink).addClass('loadingLink');
        $.ajax({
            type: 'POST',
            url: '" . Yii::app()->createUrl('/user/ajaxGetCoupon') . "',
            data: {'couponId': couponId},
            complete: function(response) {
                if(response.status == 200) {
                    $('.couponPopup').remove();
                    $('body').append('<div class=\'couponPopup\'>' + response.responseText + '</div>');
                    $('body').append('<div id=\'fade\'></div>');
                    var body_height = document.documentElement.scrollHeight;
                    $('body #fade').css('height', body_height);

                    $('#prof_pop_win').center();

                    if ($.browser.msie) {
                        $('body #fade').fadeTo(300, 0.4, function() {
                            $('#prof_pop_win').show();
                        });
                    }
                    else {
                        $('body #fade').fadeTo(300, 0.4);
                        $('#prof_pop_win').fadeTo(300, 1);
                    }

                    $('#fade').click(close_prof_pop_win);
                    $(thisLink).removeClass('loadingLink');
                }
                else
                    console.log(response);
            }
        });

        return false;
    });
", CClientScript::POS_END);
?>
<?php $this->beginContent('//layouts/main'); ?>
<tr>
    <td valign="top" height="60">
        <table width="970" align="center">
            <tr>
                <td>
                    <table class="fullWidth" height="60">
                        <tr>
                            <td width="440" valign="middle">
                                <div class="prof_cat_title">
                                    Личный кабинет
                                </div>
                            </td>
                            <td valign="bottom" align="right">
                                <table align="right">
                                    <tr>
                                        <td>
                                            <a href="<?php echo Yii::app()->createUrl('rss'); ?>" class="rss_akc_link">
                                                <div></div>
                                                <span>Акции в RSS</span>
                                            </a>
                                            <div href="#" class="go_to_site_link">
                                                <span>&gt; </span>
                                                <a href="<?php echo Yii::app()->homeUrl; ?>">Перейти на сайт</a>
                                            </div>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td height="17"></td>
                                    </tr>
                                </table>
                            </td>
                            <td width="30">&nbsp;</td>
                        </tr>
                    </table>
                </td>
            </tr>
        </table>
    </td>
</tr>


<tr>
    <td valign="top">
        <table class="profile_centr_tab" align="center">
            <tr>
                <td valign="top">
                    <table class="prof_top_line" width="100%">
                        <tr>
                            <td class="lf"></td>
                            <td class="cn" valign="middle">
                                <table>
                                    <tr>
                                        <td class="prof_top_line_tx1" valign="middle">
                                            <b>На счету:</b>
                                        </td>
                                        <td width="15"></td>
                                        <td>
                                            <div class="prof_top_line_price" style="margin-top: 1px;">
                                                <div class="price_lf"></div>
                                                <div class="price_cn">
                                                    <span><?php echo Yii::app()->user->getBalance(); ?> руб.</span>
                                                </div>
                                                <a class="price_popoln_but" href="javascript:show_replenishment();">
                                                    <div class="rz"></div>
                                                    <div class="cn">
                                                        <div class="ico_popoln_plus"></div>
                                                        <span>Пополнить</span>
                                                    </div>
                                                    <div class="rg"></div>
                                                </a>
                                            </div>
                                        </td>
                                        <td width="13"></td>
                                        <td class="prof_top_line_sp_opl" valign="middle">
                                            - <?= CHtml::link('Способы оплаты') ?>
                                        </td>
                                    </tr>
                                </table>
                            </td>
                            <td class="rg"></td>
                        </tr>
                    </table>
                </td>
            </tr>
            <tr>
                <td height="12"></td>
            </tr>
            <tr>
                <td valign="top">
                    <table class="prof_top_menu_bg" width="100%">
                        <tr>
                            <td>
                                <table width="100%">
                                    <tr>
                                        <td class="tp_lf"></td>
                                        <td class="tp_cn"><div></div></td>
                                        <td class="tp_rg"></td>
                                    </tr>
                                </table>
                            </td>
                        </tr>
                        <tr>
                            <td class="cont_bg" valign="top">
                                <div class="prof_top_menu_cols_bl">
                                    <div class="tit_row">
                                        <div class="ico_cart"></div>
                                        <div class="title">Ваши покупки</div>
                                    </div>
                                    <div class="elem_row">
                                        <a href="#" onclick="show_basket();return false;"><span><span>-</span>Корзина (<?php echo Yii::app()->shoppingCart->getItemsCount(); ?>)</span></a>
                                        <a purchaseLinksType="<?php echo Purchase::STATUS_NOT_ACTIVATED; ?>" class="purchaseLinks <?php echo $this->action->id == 'profile' ? 'active' : null; ?>" href="<?php echo Yii::app()->createUrl('/user/profile?status=' . Purchase::STATUS_NOT_ACTIVATED); ?>">
                                            <span>
                                                <span>-</span>Новые купоны
                                            </span>
                                        </a>
                                        <a purchaseLinksType="<?php echo Purchase::STATUS_ACTIVATED; ?>" class="purchaseLinks" href="<?php echo Yii::app()->createUrl('/user/profile?status=' . Purchase::STATUS_ACTIVATED); ?>">
                                            <span>
                                                <span>-</span>Использованные
                                            </span>
                                        </a>
                                    </div>
                                </div>
                                <div class="prof_top_menu_cols_bl">
                                    <div class="tit_row">
                                        <div class="ico_opt"></div>
                                        <div class="title">Ваши настройки</div>
                                    </div>
                                    <div class="elem_row">
                                        <a href="<?php echo Yii::app()->createUrl('/user/update'); ?>" class="<?php echo $this->action->id == 'update' ? 'active' : null; ?>"><span><span>-</span>Управление аккаунтом</span></a>
                                        <a href="<?php echo Yii::app()->createUrl('/user/update'); ?>"><span><span>-</span>Уведомления и рассылки</span></a>
                                    </div>
                                </div>
                                <div class="prof_top_menu_cols_bl">
                                    <div class="tit_row">
                                        <div class="ico_paym"></div>
                                        <div class="title">Платежи</div>
                                    </div>
                                    <div class="elem_row">
                                        <a href="<?php echo Yii::app()->createUrl('/user/operations'); ?>" class="<?php echo $this->action->id == 'operations' ? 'active' : null; ?>"><span><span>-</span>Архив операций</span></a>
                                    </div>
                                </div>
                                <div class="prof_top_menu_cols_bl">
                                    <div class="tit_row">
                                        <div class="ico_help"></div>
                                        <div class="title">Поддержка</div>
                                    </div>
                                    <div class="elem_row">
                                        <a href="<?php echo Yii::app()->createUrl('/page/5'); ?>"><span><span>-</span>Договор-оферта</span></a>
                                    </div>
                                    <div class="elem_row">
                                        <a href="<?php echo Yii::app()->createUrl('/page/4'); ?>"><span><span>-</span>Использование сервиса</span></a>
                                    </div>
                                    <div class="elem_row">
                                        <a href="<?php echo Yii::app()->createUrl('/feedback'); ?>"><span><span>-</span>Написать нам</span></a>
                                    </div>
                                </div>
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <table width="100%">
                                    <tr>
                                        <td class="bt_lf"></td>
                                        <td class="bt_cn"><div></div></td>
                                        <td class="bt_rg"></td>
                                    </tr>
                                </table>
                            </td>
                        </tr>
                        <tr>
                            <td height="10"></td>
                        </tr>
                        <?php echo $content; ?>
                        <tr>
                            <td height="40"></td>
                        </tr>
                    </table>
                </td>
            </tr>
        </table>
    </td>
</tr>
<?php $this->endContent(); ?>

<script type="text/javascript">
    var showBasketAfterLogin = <?php echo $_REQUEST['show_basket'] ? 1 : 0 ?>;
    if (showBasketAfterLogin) {
         show_basket();
    }
</script>