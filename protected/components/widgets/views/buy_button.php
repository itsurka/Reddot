<?php if ($act->coupon_count > $act->coupon_purchased): ?>
    <?php if ($childActions === false): ?>
        <div class="ram_yelow_dv">
            <div class="ram_yelow_dv_lf"></div>
            <div class="ram_yelow_dv_cn">
                <div><b><?php echo $act->price_new; ?> <?php echo $act->currencyStr; ?></b></div>
            </div>
            <a href="#" class="ram_yelow_dv_rg_butt putToBasket" data-actId='<?php echo $act->id; ?>'>
                <div>Купить</div>
            </a>
        </div>
    <?php else: ?>
        <div class="ram_yelow_dv">
            <div class="ram_yelow_dv_lf"></div>
            <div class="ram_yelow_dv_cn">
                <div><b><?php echo $act->price_new; ?> <?php echo $act->currencyStr; ?></b></div>
            </div>
            <a href="#" id='showKuponBay' class="ram_yelow_dv_rg_butt">
                <div>Купить</div>
            </a>
            <!-- -->	
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
                                        <?php foreach ($childActions as $action): ?>						
                                            <div class="kupon_elem">
                                                <div class="kupon_elem_inn">
                                                    <div class="col_1">
                                                        <div class="title">
                                                            <div>
                                                                <?php print $action->name_act; ?>
                                                            </div>
                                                        </div>
                                                        <div class="tx_bl_1">
                                                            <div>
                                                                Скидка: <b><?php echo $action->discount; ?>%</b>
                                                            </div>
                                                            <div>|</div>
                                                            <div>
                                                                Дата окончания: <?php echo Yii::app()->dateFormatter->format('dd MMMM yyy', $action->date_end_act); ?>
                                                            </div>
                                                            <div>|</div>
                                                            <div>
                                                                Цена: <b class="price"><?php echo $action->price_new; ?> руб.</b>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="col_2">
                                                        <a class="button_bay" href="#">
                                                            <div class="putToBasket" data-actId='<?php echo $act->id; ?>' style="z-index: 1000">Оформить</div>
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
            <!-- -->
        </div>
    <?php endif; ?>
<?php endif; ?>
