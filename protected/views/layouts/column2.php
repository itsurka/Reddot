<?php $this->beginContent('//layouts/main'); ?>
<tr>
    <td height="73" valign="top">
        <?php $this->widget('application.components.widgets.Basket'); ?>
    </td>
</tr>
<tr>
    <td valign="top">
        <table class="centr_tab" align="center">
            <tr>
                <td class="top_menu_bg_lf cn_tb_col_lf" align="right" valign="top">
                    <div class="money_have">
                        <table class="money_have_tab" align="center">
                            <tr>
                                <td height="3"></td>
                            </tr>
                            <tr>
                                <td class="money_have_title" height="29" align="center" valign="middle">
                                    <b>На вашем счёте</b>
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <table style="width: 157px; height: 30px;" align="right">
                                        <tr>
                                            <td width="70" align="center" valign="middle">
                                                <b><?php echo Yii::app()->user->getBalance(); ?> руб.</b>
                                            </td>
                                            <td>
                                                <a class="money_have_butt" href="#" onclick="<?php if(!Yii::app()->user->isGuest) echo 'show_replenishment();'; else echo 'show_login(2); return false;'; ?>">
                                                   <span>Пополнить</span>
                                                </a>
                                            </td>
                                        </tr>
                                    </table>
                                </td>
                            </tr>
                        </table>
                    </div>
                    <div class="bg_rg_tint"></div>
                </td>
                <td valign="top">
                    <?php echo $this->action->id == 'map' ? '<div class="top_toolbars">' : ''; ?>
                    <?php $this->widget('application.components.widgets.ActSearchWidget'); ?>
                    <div class="r_col_menu_elem <?php echo in_array($this->action->id, array('index', 'view', 'search')) ? 'active' : 'rcm_e1'; ?>">
                        <a href="<?php echo Yii::app()->homeUrl; ?>">
                            <span style="background-image: url('<?php echo Yii::app()->baseUrl; ?>/images/menu/m_1<?php echo in_array($this->action->id, array('index', 'view', 'search')) ? null : '_off'; ?>.png');" class="r_col_menu_img"></span><?php echo $this->action->id == 'index' ? 'Акции' : '<div>Акции</div>'; ?>
                        </a>
                    </div>
                    <div class="r_col_menu_elem <?php echo $this->action->id == 'map' ? 'active' : 'rcm_e1'; ?>">
                        <a href="<?php echo Yii::app()->createUrl('map'); ?>">
                            <span style="background-image:url('<?php echo Yii::app()->baseUrl; ?>/images/menu/m_2<?php echo $this->action->id == 'map' ? '_act' : null; ?>.png')" class="r_col_menu_img"></span><?php echo $this->action->id == 'map' ? 'Карта' : '<div>Карта</div>'; ?>
                        </a>
                    </div>
                    <div class="r_col_menu_elem <?php echo $this->action->id == 'archive' ? 'active' : 'rcm_e1'; ?>">
                        <a href="<?php echo Yii::app()->createUrl('archive'); ?>">
                            <span style="background-image:url('<?php echo Yii::app()->baseUrl; ?>/images/menu/m_3.png')" class="r_col_menu_img"></span><?php echo $this->action->id == 'archive' ? 'Прошедшие' : '<div>Прошедшие</div>'; ?>
                        </a>
                    </div>
                    <div class="menu_bg_right"></div>
                    <?php echo $this->action->id == 'map' ? '</iv>' : ''; ?>
                </td>
            </tr>
            <tr>
                <td class="bg_rg_tint2" valign="top">
                    <div class="bg_rg_tint"></div>
                    <div class="l_col_lf_marg">
                        <?php $this->widget('application.components.ActFilterThemesWidget'); ?>
                        <?php $this->widget('application.components.ActListBonusWidget'); ?>
                    </div>
                </td>
                <?php echo $content; ?>
            </tr>
        </table>
    </td>
</tr>
<tr><td style="padding-bottom: 70px;"></td></tr>
<?php $this->endContent(); ?>