<?php
if (!isset($_SESSION['show-number']) || $_SESSION['show-number'] == 2)
    $_SESSION['show-number'] = 1;
else
    $_SESSION['show-number']++;

if ($model->isForSale()):
    $model->price_new_description = str_replace('<p', '<p class="price_new_description"', $model->price_new_description);
    ?>
    <table class="cont_tab_nums" cellpadding="0" cellspacing="0" border="0">
        <tr>
            <td style="padding-right: 10px;">
                <b><?php echo $model->price_new_description; ?></b>
            </td>
            <td>
                <?php if ($model->couponCount == 1): ?>
                    <div class="ram_yelow_dv">
                        <div class="ram_yelow_dv_lf"></div>
                        <div class="ram_yelow_dv_cn">
                            <div><b><?php echo $model->firstCoupon->getPrice(); ?> <?php echo $model->currencyStr; ?></b></div>
                        </div>
                        <a href="javascript: void(0);" class="ram_yelow_dv_rg_butt putToBasket" data-actId='<?php echo $model->firstCoupon->id; ?>'>
                            <div>Купить</div>
                        </a>
                    </div>
                <?php else: ?>
                    <div class="ram_yelow_dv">
                        <div class="ram_yelow_dv_lf"></div>
                        <div class="ram_yelow_dv_cn">
                            <div><b><?php echo $model->getTotalCost(); ?> <?php echo $model->currencyStr; ?></b></div>
                        </div>
                        <a href="javascript: void(0);" id='showKuponBay' class="ram_yelow_dv_rg_butt show-number-<?php echo $_SESSION['show-number']; ?>">
                            <div>Купить</div>
                        </a>

                        <div id="kupon_bay_pop">
                            <table width="100%" cellpadding="0" cellspacing="0" border="0">
                                <tr>
                                    <td height="24">
                                        <table width="100%" cellpadding="0" cellspacing="0" border="0" height="24">
                                            <tr>
                                                <td class="rm_tp_lf"></td>
                                                <td class="rm_tp_cn" align="center"><div></div></td>
                                                <td class="rm_tp_rg"></td>
                                            </tr>
                                        </table>
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        <table width="100%" height="100%" cellpadding="0" cellspacing="0" border="0">
                                            <tr>
                                                <td class="rm_lf"></td>
                                                <td class="rm_cn" valign="top">
                                                    <?php foreach ($model->coupons as $coupon): ?>						
                                                        <div class="kupon_elem">
                                                            <div class="kupon_elem_inn">
                                                                <div class="col_1">
                                                                    <div class="title">
                                                                        <div>
                                                                            <?php print $coupon->title; ?>
                                                                        </div>
                                                                    </div>
                                                                    <div class="tx_bl_1">
                                                                        <div>
                                                                            Скидка: <b><?php echo $coupon->discount; ?>%</b>
                                                                        </div>
                                                                        <div>|</div>
                                                                        <div>
                                                                            Дата окончания: <?php echo Yii::app()->dateFormatter->format('dd MMMM yyy', $model->date_end_act); ?>
                                                                        </div>
                                                                        <div>|</div>
                                                                        <div>
                                                                            Цена: <b class="price"><?php echo $coupon->total_cost; ?> руб.</b>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                <div class="col_2">
                                                                    <a class="button_bay" href="javascript: void(0);">
                                                                        <div class="putToBasket" data-actId='<?php echo $coupon->id; ?>' style="z-index: 1000">Оформить</div>
                                                                    </a>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    <?php endforeach; ?>
                                                </td>
                                                <td class="rm_lf"></td>
                                            </tr>
                                        </table>
                                    </td>
                                </tr>
                                <tr>
                                    <td height="12">
                                        <table width="100%" cellpadding="0" cellspacing="0" border="0" height="12">
                                            <tr>
                                                <td class="rm_bt_lf"></td>
                                                <td class="rm_bt_cn" align="center"><div></div></td>
                                                <td class="rm_bt_rg"></td>
                                            </tr>
                                        </table>
                                    </td>
                                </tr>
                            </table>
                        </div>

                    </div>
                <?php endif; ?>
            </td>
            <!--<td>
                <a class="lnk_podar_blizk" href="#">
                    <div>Подарить близким</div>
                </a>
                <a class="lnk_rassk_frends" href="#">
                    <div>Рассказать друзьям</div>
                </a>
            </td>-->
        </tr>
    </table>
<?php endif; ?>
