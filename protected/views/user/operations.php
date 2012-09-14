<tr>
    <td valign="top">
        <div style="font-size: 20px;padding: 20px;">Архив операций</div>
    </td>
</tr>
<tr>
    <td class="l_col_headline2" height="1"></td>
</tr>
<td>
    <div style="margin-left: 20px;margin-right: 20px;">
        <?php
        $this->widget('zii.widgets.grid.CGridView', array(
            'dataProvider' => $model->search(),
            'itemsCssClass' => 'table table-striped',
            'summaryText' => '',
            'template' => '{items}<div style="margin-top: 40px;">{pager}</div>',
            'columns' => array(
                array(
                    'name' => 'id',
                    'htmlOptions' => array(
                        'style' => 'width: 50px;',
                    ),
                ),
                array(
                    'name' => 'title',
                    'value' => '"<b>{$data->title}</b> {$data->getPurchaseSmallLink()}"',
                    'type' => 'raw',
                    'htmlOptions' => array(
                        'style' => 'width: 150px;',
                    ),
                ),
                array(
                    'name' => 'summ',
                    'value' => '$data->summ . " руб."',
                    'type' => 'raw',
                    'htmlOptions' => array(
                        'style' => 'width: 100px;',
                    ),
                ),
                array(
                    'name' => 'created',
                    'value' => 'Yii::app()->dateFormatter->format("dd MMM yyyy в HH:mm", $data->created)',
                    'htmlOptions' => array(
                        'style' => 'width: 150px;',
                    ),
                ),
                array(
                    'name' => 'status',
                    'value' => '$data->getStatusHtml()',
                    'type' => 'raw',
                    'htmlOptions' => array(
                        'style' => 'width: 100px;',
                    ),
                ),
                'extra',
            ),
        ));
        ?>
    </div>
</td>
</tr>