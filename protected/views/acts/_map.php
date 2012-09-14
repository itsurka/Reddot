<table class="cont_tab" cellpadding="0" cellspacing="0" border="0">
    <tr>
        <td>
            <div class="kpview_marg_lf">
                <h2>Акции раздела</h2>
            </div>
        </td>
    </tr>
    <tr>
        <td height="1" class="l_col_headline2"></td>
    </tr>
    <tr>
        <td id="acts_container">
            <?php $this->renderPartial('_listView', array('dataProvider' => $dataProvider)); ?>
        </td>
    </tr>
    <tr>
        <td height="30">&nbsp;</td>
    </tr>
</table>