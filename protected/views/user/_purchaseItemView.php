<div class="prof_kupon_el_cont couponId_<?php echo $data->id; ?>">
    <table width="100%">
        <tr>
            <td valign="top">
                <div class="descr_left">
                    <?php if ($data->status == Purchase::STATUS_ACTIVATED): ?>
                        Использовано
                    <?php else: ?>
                        купон от<br>
                        <?php echo Yii::app()->dateFormatter->format('dd MMMM yyyy', $data->coupon->act->date_start_act); ?> г.<br>
                        Выгода <?php echo $data->coupon->discount; ?>%
                    <?php endif; ?>
                </div>
            </td>
            <td class="prof_kupon_el_cont_bg" valign="top">
                <table width="100%" height="100%">
                    <tr>
                        <td width="561" valign="top">
                            <div class="inner_dv">
                                <div class="title">
                                    <a href="<?php echo Yii::app()->createUrl($data->coupon->act->short_url); ?>">
                                        <?php echo $data->coupon->title; ?>
                                    </a>
                                </div>
                                <div class="oplach tx1">
                                    Оплачено ??? руб.
                                </div>
                                <div class="data_do tx1">
                                    Действует до <?php echo Yii::app()->dateFormatter->format('dd MMMM yyyy', $data->coupon->act->date_end_act); ?> г.
                                </div>
                                <div class="bott_row">
                                    <div class="kod_tx">
                                        Код для
                                        использования:
                                    </div>
                                    <a class="kod_link" href="#" couponId="<?php echo $data->id; ?>">
                                        <?php echo $data->secret_key; ?>
                                    </a>
                                    <div class="comm">
                                        <span>легко использовать по клику</span>
                                    </div>
                                </div>
                            </div>
                        </td>
                        <td valign="top">
                            <div class="image_bl">
                                <img src="<?php echo $data->coupon->act->getPictureWebPath("120x214") ?>" alt="">
                            </div>
                        </td>
                    </tr>
                </table>
            </td>
        </tr>
    </table>
</div>
<table width="100%" height="1"><tr><td height="1" class="l_col_headline2"></td></tr></table>