<?php $this->setPageTitle('Поиск акций'); ?>
<?php Yii::app()->clientScript->registerMetaTag('Поиск акций', 'description'); ?>
<?php Yii::app()->clientScript->registerMetaTag('Поиск акций', 'keywords'); ?>
<td valign="top">
    <table class="cont_tab" cellpadding="0" cellspacing="0" border="0">
        <tr>
            <td height="50" valign="top">
                <div style="font-size: 26px;margin-left: 10px;margin-top: 0px;">
                    Поиск по запросу: <?php echo CHtml::encode($model->query); ?>
                </div>
            </td>
        </tr>
        <tr>
            <td class="l_col_headline2" height="1"></td>
        </tr>
        <tr>
            <td>
                <?php if ($model->hasErrors()): ?>
                    <?php echo CHtml::errorSummary($model); ?>
                <?php else: ?>
                    <?php
                    $this->renderPartial('_listView', array(
                        'dataProvider' => $dataProvider,
                        'model' => $model
                    ));
                    ?>
                <?php endif; ?>
            </td>
        </tr>
    </table>
</td>