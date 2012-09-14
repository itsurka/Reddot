<table width="100%" cellpadding="0" cellspacing="0" border="0" height="70" id='topBar'>
    <tr>
        <?php if ((Yii::app()->user->isGuest) and ($count == 0)): ?>
            <td width="440" valign="top" class="basketChange" id='part1'>
                <table class="orn_ram_top1" cellpadding="0" cellspacing="0" border="0" align="center">
                    <tr>
                        <td class="orn_ram_top1_lf"></td>
                        <td class="orn_ram_top1_cn">
                            <a class="lnk_kak_rab" href="<?php echo Yii::app()->createUrl('page/about'); ?>">
                                <span>Как это работает?</span>
                            </a>
                        </td>
                        <td width="1" class="orn_ram_top1_cn" align="center" valign="middle">
                            <div class="orn_ram_top1_cn_rz"></div>
                        </td>
                        <td class="orn_ram_top1_cn">
                            <a class="lnk_reddot_bizn" href="<?php echo Yii::app()->createUrl('page/business'); ?>">
                                <span>RedDot для бизнеса</span>
                            </a>
                        </td>
                        <td class="orn_ram_top1_rg"></td>
                    </tr>
                </table>
            </td>
            <td width="1" valign="bottom">
                <table style="border-right: 1px #eaeaea solid;" width="1" height="65" cellpadding="0" cellspacing="0" border="0">
                    <tr>
                        <td></td>
                    </tr>
                </table>
            </td>
        <?php else: ?>
            <td width="30" class="basketChange" id='part1'>&nbsp;</td>
            <td width="190" class="basketChange" id='part2'>
                <table cellpadding="0" cellspacing="0" border="0">
                    <tr>
                        <td width="40" valign="middle">
                            <a class="ico_kabinet" href="#"></a>
                        </td>
                        <td valign="middle">
                            <a class="link_kabinet" href="<?php echo Yii::app()->createUrl('user/profile'); ?>">
                                Личный кабинет
                            </a>
                        </td>
                    </tr>
                </table>
            </td>
            <td width="1" class="basketChange" valign="bottom">
                <table style="border-right: 1px #eaeaea solid;" width="1" height="65" cellpadding="0" cellspacing="0" border="0">
                    <tr>
                        <td></td>
                    </tr>
                </table>
            </td>
            <td width="219" class="basketChange">
                <table cellpadding="0" cellspacing="0" border="0">
                    <tr>
                        <td width="65" valign="top" align="right">
                            <a class="ico_cart" href="#" onclick="show_basket();"></a>
                        </td>

                        <td align="center">
                            <div class="top_cart_tx1">
                                В корзине <span><?php echo $countReadable ?></span>
                            </div>
                            <?php if ($count > 0): ?>
                                <a id='orderBasket' href='#'>
                                    оформить
                                </a>
                            <?php endif; ?>
                        </td>
                    </tr>
                </table>
            </td>
        <?php endif; ?>
        <td width="1" valign="bottom">
            <table style="border-right: 1px #eaeaea solid;" width="1" height="65" cellpadding="0" cellspacing="0" border="0">
                <tr>
                    <td></td>
                </tr>
            </table>
        </td>
        <td>
            <?php $this->widget('application.components.widgets.SaleWidget', array('type' => 'Timer')) ?>
        </td>
        <td width="30">&nbsp;</td>
    </tr>
</table>