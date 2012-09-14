<?php $this->setPageTitle('Бонусные акции'); ?>
<?php Yii::app()->clientScript->registerMetaTag('Бонусные акции', 'description'); ?>
<?php Yii::app()->clientScript->registerMetaTag('Бонусные акции', 'keywords'); ?>

<td valign="top">
    <table class="cont_tab" cellpadding="0" cellspacing="0" border="0">
        <tr>
            <td class="l_col_headline2" height="1"></td>
        </tr>
        <tr>
            <td id="acts_container">
                <?php $this->renderPartial('_listView', array('dataProvider' => $dataProvider)); ?>
            </td>
        </tr>
    </table>
</td>