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
                                            <a href="#" class="rss_akc_link">
                                                <div></div>
                                                <span>Акции в RSS</span>
                                            </a>
                                            <div href="#" class="go_to_site_link">
                                                <span>&gt; </span>
                                                <a href="#">Перейти на сайт</a>
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
                                                <a class="price_popoln_but" href="#">
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