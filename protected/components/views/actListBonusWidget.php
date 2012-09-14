<?php if ($this->models): ?>
    <table class="l_col_headline2" cellpadding="0" cellspacing="0" border="0">
        <tr><td class="l_col_headline2"><div>Бонусные акции:</div></td></tr>
    </table>

    <div class="l_col_bonus">
        <?php foreach ($this->models as $model): ?>
            <div class="l_col_bonus_single">
                <div class="l_col_bonus_bg"></div>
                <div class="l_col_bonus_discount">-<?php echo $model->getDiscount(); ?>%</div>
                <a class="l_col_bonus_link" href="<?php echo Yii::app()->createUrl("/{$model->short_url}"); ?>"></a>
                <div class="l_col_bonus_image" style="background: url('<?php echo $model->getPictureWebPath("185x100"); ?>') no-repeat 0 0;width: 185px;height:100px;"></div>
                <div class="l_col_bonus_text">
                    <a href="<?php echo Yii::app()->createUrl("/{$model->id_act}"); ?>">
                        <?php echo $model->short_text_act; ?>
                    </a>
                </div>
            </div>
        <?php endforeach; ?>
    </div>

    <div class="link_pg_bonus_akcii">
        <div class="ico_strel_rg"></div>
        <span>страница <a href="<?php echo Yii::app()->createUrl('bonus'); ?>">бонусных акций</a></span>
    </div>
<?php endif; ?>
