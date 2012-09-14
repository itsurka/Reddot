<div id="prof_pop_win">
    <div class="marg">
        <div class="col_lf">
            <div class="bg_kod">
                <?php echo $model->secret_key; ?>
            </div>
            <div class="descr">
                сообщите этот номер в компании, где проводится акция, и получите скидку!
            </div>
            <div class="bott">
                <div class="bott_elem bord_rg">
                    <div class="ico_dv ico_karand"></div>
                    <div class="descr">
                        запишите <br>или <a href="#" onclick="window.print();return false;">распечатайте</a>
                    </div>
                </div>
                <div class="bott_elem bord_rg">
                    <div class="ico_dv ico_phone"></div>
                    <div class="descr">
                        или сфотографируйте<br>
                        на телефон
                    </div>
                </div>
                <div class="bott_elem bord_rg">
                    <div class="ico_dv ico_pict"></div>
                    <div class="descr">
                        <a href="<?php echo Yii::app()->createUrl('user/image/' . $model->id); ?>" target="__blanc">скачать картинкой</a>
                    </div>
                </div>
                <div class="bott_elem">
                    <div class="ico_dv ico_email"></div>
                    <div class="descr">
                        <a href="javascript:show_prof_pop_win_email();">отправить <br>на e-mail</a>
                    </div>
                </div>
            </div>
            <div class="send_email_div">
                <a class="close" href="javascript:close_prof_pop_win_email();"></a>
                <div class="row_send">
                    <div class="inp_dv">
                        <input name="a" id="sendCouponToEmail" couponId="<?php echo $model->id; ?>" type="text" value="" placeholder="Введите ваш е-мейл адрес" maxlength="255">
                    </div>
                    <a class="send" href="javascript:send_prof_pop_win_email();">
                        <div class="ico_email"></div>
                        <span>отправить купон</span>
                    </a>
                </div>
            </div>
        </div>
        <div class="col_rg">
            <div class="qr_kod_im">
                <div style="background: url('<?php $this->widget('ext.qrcode.QRCodeGenerator', array('data' => $model->secret_key)); ?>') no-repeat center center;"></div>

            </div>
            <div class="qr_kod_tx">
                возможно использовать<br>
                QR-код. <a href="#" id="couponWhatIsIt">Что это?</a>
            </div>
        </div>
    </div>
</div>