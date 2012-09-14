<?php $this->setPageTitle($model->seo_title); ?>
<?php Yii::app()->clientScript->registerMetaTag($model->seo_description, 'description'); ?>
<?php Yii::app()->clientScript->registerMetaTag($model->seo_keywords, 'keywords'); ?>

<?php Yii::app()->clientScript->registerScript('act/view', "
    $('.kpviewSubpg').live('click', function(){
        var label = '';
        var currentTab = $(this);

        if($(currentTab).hasClass('kpview_subpg_act'))
            return false;

        label = $('.kpview_subpg_act .label').html();
        $('.kpview_subpg_act').html($('#templateTab').html().replace('{label}', label));
        $('.kpview_subpg_act').addClass('kpview_subpg_act');
        $('.kpview_subpg_act').removeClass('kpview_subpg_act');

        label = $(currentTab).find('.label').html();
        $(currentTab).removeClass('kpview_subpg');
        $(currentTab).addClass('kpview_subpg_act');
        $(currentTab).html($('#templateTabActive').html().replace('{label}', label));

        if(label == 'Комментарии') {
            $('#tabContent1').hide();
            $('#tabContent2').show();
        }
        else {
            $('#tabContent1').show();
            $('#tabContent2').hide();
        }

        return false;
    });
"); ?>

<!-- Костыли для ебанутой верстки. Шаблон для активной ссылки. -->
<script type="text/plain" id="templateTabActive">
    <div class="kpview_subpg_act kpviewSubpg" tabId="">
        <div class="kpview_subpg_act_lf"></div>
        <div class="kpview_subpg_act_cn">
            <div class="label" tabid="{tabid}">{label}</div>
        </div>
        <div class="kpview_subpg_act_rg"></div>
    </div>
</script>

<!-- Костыли для ебанутой верстки. Шаблон для не активной ссылки. -->
<script type="text/plain" id="templateTab">
    <div class="kpview_subpg kpviewSubpg" tabId=""><a href="#" class="label" tabid="{tabid}">{label}</a></div>
</script>

<td id="content_all" valign="top">
    <table width="761" cellpadding="0" cellspacing="0" border="0">
        <tr>
            <td id="mark_hg_header1" height="50"  valign="top"></td>
        </tr>
        <tr>
            <td class="bg_page_rg_red" valign="top">
                <table class="cont_tab" cellpadding="0" cellspacing="0" border="0">
                    <tr>
                        <td class="l_col_headline2" height="1"></td>
                    </tr>
                    <tr>
                        <td class="cont_tab_tx">
                            <div class="cont_tab_dv1">
                                <div>
                                    <div class="cont_tab_title_gd">
                                        <?php echo CHtml::encode($model->name_act); ?>
                                    </div>

                                    <?php
                                    $this->renderPartial('_buyButton', array(
                                        'model' => $model,
                                        'childActions' => $childActions,
                                    ));
                                    ?>

                                </div>
                            </div>
                        </td>
                    </tr>
                </table>
                <table width="100%" cellpadding="0" cellspacing="0" border="0">
                    <tr>
                        <td class="bg_page_rg_red2">
                            <table align="center" width="745" cellpadding="0" cellspacing="0" border="0">
                                <tr>
                                    <td height="1"><div class="hr_grey_white_2"></div></td>
                                </tr>
                                <tr>
                                    <td id="mark_hg_red1" class="hr_grey_bot_1" style="background-color: #fff9e4;" valign="middle">
                                        <table width="100%" cellpadding="0" cellspacing="0" border="0">
                                            <tr>
                                                <td width="550" valign="middle">
                                                    <div class="kpview_bg_im_dv">
                                                        <div class="kpview_bg_im_ram_rg"></div>
                                                        <div class="kpview_bg_im" style="background: url('<?php echo $model->getPictureWebPath("550x315") ?>') no-repeat 0 1px;"></div>
                                                    </div>
                                                </td>
                                                <td>
                                                    <table width="100%" cellpadding="0" cellspacing="0" border="0">
                                                        <tr>
                                                            <td class="kpview_rgtx_td" height="75">
                                                                <?php if ($model->endActionStr): ?>
                                                                    <div class="kpview_rgtx_mr1 kpview_rgtx_1">До конца акции</div>
                                                                    <div class="ico_time"></div>
                                                                    <div class="kpview_rgtx_2"><b><?php echo $model->endActionStr; ?></b></div>
                                                                <?php else: ?>
                                                                    <div class="ico_time"></div>
                                                                    <div class="kpview_rgtx_2">Акция закончилась</div>
                                                                <?php endif; ?>
                                                            </td>
                                                        </tr>
                                                        <tr><td height="1"><div class="hr_grey_white_2"></div></td></tr>
                                                        <tr>
                                                            <td class="kpview_rgtx_td" height="85">
                                                                <div class="kpview_rgtx_mr1">
                                                                    <span class="kpview_rgtx_3"><?php echo $model->coupon_purchased; ?></span>&nbsp;&nbsp;<span class="kpview_rgtx_1">купили</span></div>
                                                            </td>
                                                        </tr>
                                                        <tr><td height="1"><div class="hr_grey_white_2"></div></td></tr>
                                                        <tr>
                                                            <td class="kpview_rgtx_td" height="85">
                                                                <div class="kpview_rgtx_mr1">
                                                                    <span class="kpview_rgtx_3"><?php echo $model->getCouponRemaining(); ?></span>&nbsp;&nbsp;<span class="kpview_rgtx_1">купонов осталось</span></div>
                                                            </td>
                                                        </tr>
                                                        <tr><td height="1"><div class="hr_grey_white_2"></div></td></tr>
                                                        <tr>
                                                            <td class="kpview_rgtx_td" height="75">
                                                                <div class="kpview_rgtx_mr1">
                                                                    <div class="kpview_rgtx_1">
                                                                        Скидка активна по
                                                                    </div>
                                                                    <div class="kpview_rgtx_2">
                                                                        <?php echo Yii::app()->dateFormatter->format('dd MMMM yyy', $model->date_end_act); ?>
                                                                    </div>
                                                                </div>
                                                            </td>
                                                        </tr>
                                                    </table>
                                                </td>
                                            </tr>
                                        </table>

                                    </td>
                                </tr>
                            </table>
                            <div id="mark_line1"></div>
                        </td>
                    </tr>
                </table>
            </td>
        </tr>
    </table>
    <table class="cont_tab" cellpadding="0" cellspacing="0" border="0">
        <tr>
            <td height="20" valign="top">

            </td>
        </tr>
        <tr>
            <td>
                <div class="kpview_subpg_menu">
                    <div class="kpview_subpg_act kpviewSubpg">
                        <div class="kpview_subpg_act_lf"></div>
                        <div class="kpview_subpg_act_cn">
                            <div class="label">Описание</div>
                        </div>
                        <div class="kpview_subpg_act_rg"></div>
                    </div>
                    <div class="kpview_subpg kpviewSubpg">
                        <a href="#" class="label">Комментарии</a>
                    </div>
                </div>
            </td>
        </tr>
        <tr>
            <td class="l_col_headline2" height="1"></td>
        </tr>
        <tr>
            <td height="10"></td>
        </tr>
        <tr>
            <td>
                <table class="kpview_content" align="right" width="715" cellpadding="0" cellspacing="0" border="0">
                    <tr>
                        <td width="526" valign="top">
                            <div class="kpview_cnt_brd_rg kpview_cnt_pd_rg">
                                <div id="tabContent1">
                                    <?php echo $model->full_text_act; ?>
                                </div>
                                <div id="tabContent2" style="display:none;">
                                    <?php $this->widget('application.components.widgets.Disqus'); ?>
                                </div>
                            </div>
                            <br>
                            <div class="hr_grey_white_2"></div>
                            <div class="kpview_cnt_pd_rg">
                                <br>
                                <?php
                                $this->renderPartial('_buyButton', array(
                                    'model' => $model,
                                    'childActions' => $childActions,
                                ));
                                ?>
                            </div>
                            <br><br><br><br>
                        </td>
                        <td valign="top">
                            <div class="kpview_rg_col">
                                <table width="100%" cellpadding="0" cellspacing="0" border="0">
                                    <tr>
                                        <td valign="top">
                                            <h3><?php echo $model->user->company_name; ?></h3>
                                            <?php if ($model->user->working_time): ?>
                                                <div style="margin-bottom: 20px;">
                                                    <b>Время работы:</b><br>
                                                    <?php echo nl2br(CHtml::encode($model->user->working_time)); ?>
                                                </div>
                                            <?php endif; ?>

                                            <?php if ($model->user->phone): ?>
                                                <div style="margin-bottom: 20px;">
                                                    <b>Телефон:</b><br>
                                                    <?php echo nl2br(CHtml::encode($model->user->phone)); ?>
                                                </div>
                                            <?php endif; ?>

                                            <?php if ($model->user->address): ?>
                                                <div style="margin-bottom: 20px;">
                                                    <b>Адреса:</b><br>
                                                    <div style="line-height: 22px;">
                                                        <?php echo $model->user->getAddressToStr('<br />'); ?>
                                                    </div>
                                                </div>
                                            <?php endif; ?>

                                            <!--<a href="#">смотреть на карте</a>-->
                                            <?php if ($model->user->website): ?>
                                                <b>Адрес:</b><br>
                                                <a href="http://<?php echo $model->user->website; ?>" target="_blank">
                                                    <?php echo $model->user->website; ?>
                                                </a>
                                            <?php endif; ?>
                                            <?php if ($model->terms): ?>
                                                <h3>Условия акции</h3>
                                                <div class="small">
                                                    <?php echo $model->terms; ?>
                                                </div>
                                            <?php endif; ?>

                                        </td>
                                    </tr>
                                </table>
                            </div>
                        </td>
                    </tr>
                </table>
            </td>
        </tr>
        <?php $this->widget('application.components.ActListWidget', array('model' => $model)); ?>
        <tr>
            <td height="30">&nbsp;</td>
        </tr>
    </table>
</td>