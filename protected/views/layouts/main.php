<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN"
    "http://www.w3.org/TR/html4/loose.dtd">
<html>
    <head>
        <meta http-equiv="content-type" content="text/html; charset=utf-8">
        <title><?php echo CHtml::encode($this->pageTitle); ?></title>
        <meta content="INDEX,FOLLOW" name="robots"/>

        <link href='http://fonts.googleapis.com/css?family=PT+Sans:400,700&subset=latin,cyrillic' rel='stylesheet' type='text/css'>
        <link href="<?php echo Yii::app()->baseUrl; ?>/css/style.css" rel="stylesheet" type="text/css" />
        <link href="<?php echo Yii::app()->baseUrl; ?>/css/form.css" rel="stylesheet" type="text/css" />
        <link href="<?php echo Yii::app()->baseUrl; ?>/css/other.css" rel="stylesheet" type="text/css" />
        <link href="<?php echo Yii::app()->baseUrl; ?>/css/print.css" media="print" rel="stylesheet" type="text/css" />
    <!--<script type="text/javascript" src="<?php //echo Yii::app()->baseUrl;                                                                                                    ?>/js/jquery-1.4.2.min.js"></script>-->
    <!--<script type="text/javascript" src="jquery.pngFix.pack.js"></script>-->

    <!--<script type="text/javascript" src="<?php echo Yii::app()->baseUrl; ?>/js/jquery-1.7.2.min.js"></script> -->
        <script type="text/javascript" src="<?php echo Yii::app()->baseUrl; ?>/js/jquery.ui.core.min.js"></script>
        <script type="text/javascript" src="<?php echo Yii::app()->baseUrl; ?>/js/jquery.ui.widget.min.js"></script>
        <script type="text/javascript" src="<?php echo Yii::app()->baseUrl; ?>/js/jquery.ui.mouse.min.js"></script>
        <script type="text/javascript" src="<?php echo Yii::app()->baseUrl; ?>/js/jquery.ui.draggable.min.js"></script>
        <script type="text/javascript" src="<?php echo Yii::app()->baseUrl; ?>/js/jquery.ui.droppable.min.js"></script>

        <script type="text/javascript" src="<?php echo Yii::app()->baseUrl; ?>/js/selectbox.js"></script>
        <!--<script type="text/javascript" src="<?php //echo Yii::app()->baseUrl;                                                                                                      ?>/js/map_script.js"></script>-->
        <script type="text/javascript" src="<?php echo Yii::app()->baseUrl; ?>/js/script.js"></script>
        <!--[if IE 7]>
        <script src="<?php echo Yii::app()->baseUrl; ?>/js/DD_belatedPNG.js"></script>
        <script type="text/javascript">
          DD_belatedPNG.fix('.bg_png, img');
        </script>
        <![endif]-->
        <script type="text/javascript">
            $(document).ready(function() {
                var _show_login = <?php echo $_REQUEST['show_login'] ? 1 : 0; ?>;
                if (_show_login) {
                    show_login(1);
                }
            });
        </script>

        <script type="text/javascript" src="<?php echo Yii::app()->baseUrl; ?>/js/listview/jquery.yiilistview.js"></script>
        <script type="text/javascript" src="<?php echo Yii::app()->baseUrl; ?>/js/other.js"></script>
        <?php Yii::app()->clientScript->registerScript('widgets/replenishment', "
            // Оплата через киви
            $('.paym_bl a#qiwiBuyLink').live('click', function() {
                var promptDesc = 'Введите номер телефона, на который нужно выписать. Например: 9104456782 ';
                var link = '" . Yii::app()->createUrl('operation/qiwi?') . "';
                var mobile = '';
                var paymentParams = {};
                var typePaymentPurchase = '" . Operation::TYPE_PAYMENT_PURCHASE . "';
                var typeDeposit = '" . Operation::TYPE_DEPOSIT . "';
                var summValue = 0;

                // Если это покупка товаров
                if($(this).data('type') == typePaymentPurchase) {
                    mobile = prompt(promptDesc);
                    paymentParams.mobile = mobile;
                    paymentParams.type = typePaymentPurchase;
                }
                // Если это пополнение счета
                else if($(this).data('type') == typeDeposit) {
                    summValue = $('.replenishment-text-field').val();
                    if(summValue > 0) {
                        mobile = prompt(promptDesc);
                        if(mobile) {
                            paymentParams.mobile = mobile;
                            paymentParams.type = typeDeposit; //пополнение счета
                            paymentParams.summ = summValue;
                        }
                    }
                    else {
                        $('.replenishment-text-field').focus();
                        return false;
                    }
                }

                window.location = link + URL.serialize(paymentParams);
                return false;
            });

        "); ?>
    </head>
    <body>
        <?php $this->widget('UserMenuWidget'); ?>
        <div class="bg">
            <div class="header_bg"></div>
            <table id="main" align="center">
                <tr>
                    <td class="bg_logo">
                        <table id="header_tab">
                            <tr>
                                <td class="logo_td">
                                    <a href="<?php echo Yii::app()->homeUrl; ?>"></a>
                                </td>
                                <?php if (Yii::app()->user->isGuest): ?>
                                    <td width="305">
                                        <table class="fullWidth">
                                            <tr>
                                                <td align="center">
                                                    <a onclick="show_login(1); return false;" class="lnk_dash" href="<?php echo Yii::app()->createUrl('user/login'); ?>"><b>Войти</b></a> или <a onclick="show_login(2); return false;" class="lnk_dash" href="<?php echo Yii::app()->createUrl('user/register'); ?>"><b>зарегистрироваться</b></a>
                                                </td>
                                            </tr>
                                        </table>
                                    </td>
                                <?php else: ?>
                                    <td width="305">
                                        <table class="fullWidth">
                                            <tr>
                                                <td align="right">
                                                    <a class="lnk_dash" href="<?php echo Yii::app()->createUrl('user/profile'); ?>">
                                                        <b><?php echo Yii::app()->user->displayName; ?></b>
                                                    </a>, приветствуем вас!
                                                </td>
                                                <td width="50" align="right">
                                                    <a class="lnk_dash" href="<?php echo Yii::app()->createUrl('user/logout'); ?>">Выйти</a>
                                                </td>
                                            </tr>
                                        </table>
                                    </td>
                                <?php endif; ?>
                                <td width="22" valign="middle" align="center">
                                    <div class="rz"></div>
                                </td>
                                <td width="265">
                                    <table>
                                        <tr>
                                            <td width="80">
                                                Ваш город:
                                            </td>
                                            <td>
                                                <a onclick="switch_city(); return false;" class="select_stat_lnk" href="#">
                                                    <span>
                                                        <?php
                                                        if (Yii::app()->user->getTown()) :
                                                            echo Yii::app()->user->getTown()->name_towns;
                                                        endif;
                                                        ?>
                                                    </span>
                                                </a>
                                            </td>
                                        </tr>
                                    </table>
                                </td>
                                <td width="22" valign="middle" align="center">
                                    <div class="rz"></div>
                                </td>
                                <td>
                                    <table>
                                        <tr>
                                            <td width="25">
                                                <div class="ico_bonus"></div>
                                            </td>
                                            <td>
                                                <?php
                                                $this->widget('application.components.widgets.BalloonWidget', array(
                                                    'contents' => '<div style="text-align:center;margin-top: 5px;margin-bottom: 5px;">За покупку и использование купонов вы получаете бонусы!<br /> Бонусами можно расплатиться, купив любую <br />акцию из раздела бонусных акций. Также вы можете приобрести за <br />бонусы любую другую акцию во время супер-распродажи! <br />Бонусы начисляются только после активации вашего купона в <br />компании, где вы его используете.</div>',
                                                    'item' => '#bonusHoverLink',
                                                ));
                                                ?>
                                                Бонусы: <a class="lnk_dash" id="bonusHoverLink" href="#"><b><?php echo Yii::app()->user->getBonus(); ?></b></a>
                                            </td>

                                        </tr>
                                    </table>
                                </td>
                            </tr>
                        </table>
                    </td>
                </tr>
                <tr>
                    <td>
                        <div class="act_disc_title">
                            актуальные <span>скидки</span>
                        </div>
                    </td>
                </tr>
                <?php echo $content; ?>
                <tr>
                    <td class="bg_bott_tint">
                        <table class="bg_bott_tint_block" align="center">
                            <tr>
                                <td style="text-align: right; vertical-align: middle; height: 70px;">
                                    <table style="width: auto; margin: 0 0 0 auto;">
                                        <tr>
                                            <td style="text-align: right;">
                                                <a style="background: url(<?php echo Yii::app()->baseUrl; ?>/images/ico_vkont.png);" href="#"></a>
                                                <a style="background: url(<?php echo Yii::app()->baseUrl; ?>/images/ico_twitt.png);" href="#"></a>
                                                <a style="background: url(<?php echo Yii::app()->baseUrl; ?>/images/ico_facebook.png);" href="#"></a>
                                            </td>
                                            <td width="8"></td>
                                        </tr>
                                    </table>
                                </td>
                            </tr>
                            <tr>
                                <td class="l_col_headline2" height="1"></td>
                            </tr>
                        </table>
                    </td>
                </tr>
                <tr>
                    <td height="10"></td>
                </tr>
                <tr>
                    <td>
                        <table style="width: 915px;" align="center">
                            <tr>
                                <td>
                                    <table class="fullWidth">
                                        <tr>
                                            <td width="99">
                                                <a class="logo_bott" href="<?php echo Yii::app()->homeUrl; ?>"></a>
                                            </td>
                                            <td class="alignRight fullWidth">
                                                <table style="margin: 0 0 0 auto;">
                                                    <tr>
                                                        <td class="bott_menu_1">
                                                            <?php foreach (Page::model()->findAll() as $page): ?>
                                                                <a href="<?php echo Yii::app()->createUrl($page->getName()); ?>"><?php echo $page->title; ?></a>
                                                            <?php endforeach; ?>
                                                            <!--
                                                                <a href="<?php echo Yii::app()->createUrl('/user/profile'); ?>">Личный кабинет</a>
                                                                <a href="<?php echo Yii::app()->createUrl('/feedback'); ?>">Связаться</a>
                                                                <a href="<?php echo Yii::app()->createUrl('/partner'); ?>">Партнёрам</a>
                                                                <a href="<?php echo Yii::app()->createUrl('/about'); ?>">Как это работает?</a>
                                                                <a href="<?php echo Yii::app()->createUrl('/contract'); ?>">Договор-оферта</a>
                                                            -->
                                                        </td>
                                                    </tr>
                                                </table>
                                            </td>
                                        </tr>
                                    </table>
                                </td>
                            </tr>
                            <tr>
                                <td height="8"></td>
                            </tr>
                            <tr>
                                <td>
                                    <table class="fullWidth">
                                        <tr>
                                            <td class="bott_copyright">
                                                © <?php echo date('Y'); ?> - REDDOT. Все права защищены.
                                            </td>
                                            <td class="bott_contact" align="right">
                                                <?php echo nl2br(CHtml::encode(Town::model()->getDescription())); ?>
                                            </td>
                                        </tr>
                                    </table>
                                </td>
                            </tr>
                        </table>
                    </td>
                </tr>
                <tr>
                    <td height="10"></td>
                </tr>
            </table>
        </div>
        <?php $this->widget('application.components.widgets.Basket', array('mode' => 'full')); ?>
        <?php $this->widget('application.components.widgets.SaleWidget', array('type' => 'Popup')); ?>
        <?php $this->widget('application.components.widgets.ReplanishmentWidget'); ?>
    </body>
</html>