<tr>
    <td valign="top">
        <!-- active -->
        <div class="prof_kupon_el"  id="purchaseNewArea">
            <div class="prof_kupon_el_title">
                <div>
                    <a href="/user/profile?status=<?php echo Purchase::STATUS_NOT_ACTIVATED; ?>" purchaseType="<?php echo Purchase::STATUS_NOT_ACTIVATED; ?>">
                        <div>Новые приобретённые купоны</div><div class = "strel"></div>
                    </a>
                </div>
            </div>
            <div class="slide"><?php $this->renderPartial('_purchaseItemsList', array('dataProvider' => $dataProvider)); ?></div>
        </div>
    </div>
    <div class="prof_kupon_el" id="purchaseUsedArea">
        <div class="prof_kupon_el_title">
            <div>
                <a href="/user/profile?status=<?php echo Purchase::STATUS_ACTIVATED; ?>" purchaseType="<?php echo Purchase::STATUS_ACTIVATED; ?>">
                    <div>Использованные</div><div class = "strel"></div>
                </a>
            </div>
        </div>
        <div class = "slide"></div>
    </div>
</td>
</tr>