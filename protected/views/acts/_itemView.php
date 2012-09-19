<div class="gd_elem item_id_<?php echo $data->id_act; ?>">
    <div class="gd_elem_ram"></div>
    <div class="gd_elem_disc">
        <span>
            -<?php echo $data->discount; ?>%
        </span>
    </div>
    <?php if (!Yii::app()->user->isGuest): ?>
        <?php if ($data->isFav): ?>
            <a class="gd_elem_fav_act" itemId="<?php echo $data->id_act; ?>" href="#"><div></div></a>
        <?php else: ?>
            <a class="gd_elem_fav" itemId="<?php echo $data->id_act; ?>" href="#"><div></div></a>
        <?php endif; ?>
    <?php endif; ?>
    <a class="gd_elem_hover_bg" href="<?php echo Yii::app()->createUrl("/{$data->short_url}"); ?>">
        <div class="tx1">
            <div><?php echo nl2br(CHtml::encode($data->short_text_act)); ?></div>
            <div class="tx2">На страницу акци →</div>
        </div>
    </a>
    <div class="gd_elem_im" style="background: url('<?php echo $data->getPictureWebPath("340x185") ?>') no-repeat 0 0;"></div>
    <div class="gd_elem_title">
        <?php echo CHtml::link(CHtml::encode($data->shortName), array("/{$data->short_url}")); ?>
    </div>
    <div class="gd_elem_info">
        <table class="gd_elem_info_tab" cellpadding="0" cellspacing="0" border="0" align="center">
            <tr>
                <td width="80" valign="top">
                    <div class="gd_elem_info_price_red">
                        <?php echo $data->getTotalCost(); ?> <?php echo $data->currencyStr; ?>
                    </div>
                </td>
                <td class="gd_elem_info_brd_dtt" width="10"></td>
                <?php if ($data->endActionStr): ?>
                    <td width="125" valign="top">
                        <div><b>До конца акции</b></div>
                        <div><b><?php echo $data->endActionStr; ?></b></div>
                    </td>
                    <td class="gd_elem_info_brd_dtt" width="10"></td>
                    <td valign="top">
                        <div><b>Осталось</b></div>
                        <a class="d_elem_info_nm_kupon" href="#"><?php echo $data->coupon_count - $data->coupon_purchased; ?> купонов</a>
                    </td>
                <?php else: ?>
                    <td width="125" valign="top">
                        <div><b>Эта акция уже закончилась</b></div>
                    </td>
                <?php endif; ?>
            </tr>
        </table>
    </div>
</div>