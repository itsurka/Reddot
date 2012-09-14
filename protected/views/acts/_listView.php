<?php Yii::app()->clientScript->registerScript('listView', "
    $('.gd_elem_fav_act, .gd_elem_fav').live('click', function(){
        var itemId = $(this).attr('itemId');
        if($(this).hasClass('gd_elem_fav')) {
            $(this).removeClass('gd_elem_fav').addClass('gd_elem_fav_act');
            var url = '" . Yii::app()->createUrl('acts/fav') . "';
        }
        else {
            $(this).removeClass('gd_elem_fav_act').addClass('gd_elem_fav');
            var url = '" . Yii::app()->createUrl('acts/unfav') . "';
            if($('.type_top_menu_fav').hasClass('mn2_act'))
                $('.item_id_' + itemId).fadeOut();
        }

        $.ajax({
            url: url,
            data: {'id': itemId},
            complete: function(response) {
                
            },
        });

        return false;
    });
"); ?>

<div class="gd_elem_block">
    <?php
    $this->widget('ListView', array(
        'dataProvider' => $dataProvider,
        'itemView' => 'application.views.acts._itemView',
        'pager' => array('class' => 'LinkPager'),
        'template' => '{items}<br />{pager}',
        'baseScriptUrl' => Yii::app()->baseUrl . '/js/listview',
        'summaryText' => '',
        'emptyText' => "<div style='margin: 10px;'>" . (Yii::app()->controller->action->id == 'search' ? "Па запросу \"" . CHtml::encode($model->query) . "\" ничего не найдено" : 'Нет результатов.' ) . "</div>",
    ));
    ?>
</div>