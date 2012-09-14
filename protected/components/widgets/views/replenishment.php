<!-- 
    qiwiMobileLink 
    qiwiMobileField
    #qiwi_mobile_popup
-->
<div id="shop_replenishment">
    <table width="100%" cellpadding="0" cellspacing="0" border="0">
        <tr>
            <td class="b_ram_tp_rw">
                <table width="100%" cellpadding="0" cellspacing="0" border="0">
                    <tr>
                        <td class="b_ram_tp_lf"></td>
                        <td class="b_ram_tp_cn" align="center">
                            <a class="close_cart" href="javascript:close_replenishment();">
                                <div></div>
                                <span>Закрыть</span>
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
                                <form method="POST" id="depositForm" action="<?php echo Yii::app()->createUrl('operation/success/type/' . Operation::TYPE_DEPOSIT); ?>">
                                    Пополнить счет на <input type="text" class="replenishment-text-field" name="deposit_summ" maxlength="5"> руб.
                                    <input type="hidden" name="<?php echo Yii::app()->request->csrfTokenName; ?>" value="<?php echo Yii::app()->request->csrfToken; ?>" />
                                </form>
                            </div>
                        </td>
                        <td class="b_ram_rg_1"></td>
                    </tr>
                </table>
            </td>
        </tr>
        <?php $this->render('application.components.widgets.views.basket_terminals', array('type' => Operation::TYPE_DEPOSIT)); ?>
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