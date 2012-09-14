<?php $this->setPageTitle($model->seo_title); ?>
<?php Yii::app()->clientScript->registerMetaTag($model->seo_description, 'description'); ?>
<?php Yii::app()->clientScript->registerMetaTag($model->seo_keywords, 'keywords'); ?>

<td valign="top">
    <table class="cont_tab" cellpadding="0" cellspacing="0" border="0">
        <tr>
            <td height="50" valign="top">
                <h1 style="margin: 0px 20px;"><?php echo $model->title; ?></h1>
            </td>
        </tr>
        <tr>
            <td class="l_col_headline2" height="1"></td>
        </tr>
        <tr>
            <td style="padding-left: 20px;">
                <?php echo $model->text; ?>
            </td>
        </tr>
    </table>
</td>