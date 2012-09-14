<td valign="top">
    <table class="cont_tab" cellpadding="0" cellspacing="0" border="0">
        <tr>
            <td height="50" valign="top">
                <h1 style="margin: 0px 20px;">Покупка товаров из корзины</h1>
            </td>
        </tr>
        <tr>
            <td class="l_col_headline2" height="1"></td>
        </tr>
        <tr>
            <td style="padding: 20px;">
                <?php foreach ($operations as $model): ?>
                    <?php echo $model->title; ?><br />
                    <?php echo $model->description; ?><br />
                    <?php echo $model->summ; ?><br />
                    <?php echo $model->status; ?><br />
                    <?php echo $model->extra; ?><br />
                    -------------------------<br />
                <?php endforeach; ?>
            </td>
        </tr>
    </table>
</td>