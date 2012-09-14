<div class="bg_search">
    <?php
    $form = $this->beginWidget('CActiveForm', array(
        'action' => Yii::app()->createUrl('search'),
        'method' => 'GET',
        'htmlOptions' => array(
            'class' => 'form_search',
        ),
    ));
    ?>
    <table class="bg_search_tab">
        <tr>
            <td width="176" valign="middle" align="center">
                <?php echo $form->textField($this->model, 'query', array('class' => 'bg_search_input', 'placeholder' => 'Введите запрос поиска')); ?>
            </td>
            <td>
                <a class="bg_search_butt" href="#" onclick="$('.form_search').submit();"></a>
            </td>
        </tr>
    </table>
    <?php $this->endWidget('CActiveForm') ?>
</div>