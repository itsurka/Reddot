<div id="shop_basket">
    <?php $this->render('application.views.user._paymentForm'); ?>
    <table width="100%" cellpadding="0" cellspacing="0" border="0">
        <tr>
            <td class="b_ram_tp_rw">
                <table width="100%" cellpadding="0" cellspacing="0" border="0">
                    <tr>
                        <td class="b_ram_tp_lf"></td>
                        <td class="b_ram_tp_cn" align="center">
                            <a class="close_cart" href="javascript:close_basket();">
                                <div></div>
                                <span>свернуть корзину</span>
                            </a>
                        </td>
                        <td class="b_ram_tp_rg"></td>
                    </tr>
                </table>
            </td>
        </tr>
        <tr>
            <td>
                <table width="100%" cellpadding="0" cellspacing="0" border="0">
                    <tr>
                        <td class="b_ram_lf_1"></td>
                        <td class="b_ram_cn_bg">
                            <div class="brd_tp_el"></div>
                            <?php foreach ($positions as $coupon): ?>
                                <div class="kup_elem">
                                    <div class="col_1">
                                        <a class="title" href="#">
                                            <?php echo CHtml::encode($coupon->title); //echo str_repeat('&nbsp;', 70 - strlen($act->name_act)); ?>
                                        </a>
                                        <div class="bot_tx">
                                            <div>
                                                Скидка: <b><?php echo $coupon->discount ?> %</b>
                                            </div>
                                            <div>
                                                |
                                            </div>
                                            <div>
                                                Дата окончания: <?php echo $coupon->act->endDateReadable; ?>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col_2">
                                        <a class="close_lnk deleteFromBasket" href="#" data-actid='<?php echo $coupon->id ?>'>
                                            <div></div>
                                            <span>удалить</span>
                                        </a>
                                        <div class="nums_row">
                                            <div class="nm_tx">
                                                <div>
                                                    Кол-во:
                                                </div>
                                            </div>
                                            <div class="nm_inp_dv">
                                                <input data-actid='<?php echo $coupon->id ?>' class='updateBasket' name="a" type="text" value="<?php echo $coupon->getQuantity() ?>" maxlength="3">
                                            </div>
                                            <div class="nm_price">
                                                <div>
                                                    <?php echo Yii::app()->format->formatNumber($coupon->getSumPrice()) ?> руб.
                                                </div>
                                            </div>
                                            <div class="nm_rm_rg"></div>
                                        </div>
                                    </div>
                                </div>
                            <?php endforeach; ?>
                            <div style="height: 16px;"></div>
                        </td>
                        <td class="b_ram_rg_1"></td>
                    </tr>
                </table>
            </td>
        </tr>
        <tr>
            <td>
                <table width="100%" cellpadding="0" cellspacing="0" border="0">
                    <tr>
                        <td class="b_ram_lf_1"></td>
                        <td class="b_ram_cn_inf" valign="top">
                            <div class="nums_kup_all">
                                У вас в корзине <b><?php echo $count ?></s></b> <?php echo $countWord; ?>
                            </div>
                            <div class="summ_kup_all">
                                на сумму <?php echo Yii::app()->format->formatNumber($cost); ?> руб.
                            </div>
                        </td>
                        <td class="b_ram_rg_1"></td>
                    </tr>
                </table>
            </td>
        </tr>
        <?php if ($count > 0): ?>
            <?php $this->render('basket_terminals', array('type' => Operation::TYPE_PAYMENT_PURCHASE)); ?>
        <?php endif ?>
        <tr>
            <td>
                <table width="100%" cellpadding="0" cellspacing="0" border="0">
                    <tr>
                        <td class="b_ram_bt_lf"></td>
                        <td class="b_ram_bt_cn">&nbsp;</td> 
                        <td class="b_ram_bt_rg"></td>
                    </tr>
                </table>
            </td>
        </tr>
    </table>
</div>