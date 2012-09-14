<ul class="breadcrumb">
    <li>
        <a href="<?php echo Yii::app()->createUrl('manager'); ?>">Купленные купоны</a> &rarr;
        Просмотр купона
    </li>
</ul>
<div class="row">
    <div class="span9">
        <div>
            <div>
                <h2 class="pull-left">Просмотр купона</h2>
                <a href="<?php echo Yii::app()->createUrl('manager'); ?>" class="btn pull-right" type="submit">
                    Вернуться назад
                </a>
            </div>
            <div style="clear:both;"></div>
            <hr />
            <?php
            $this->widget('zii.widgets.CDetailView', array(
                'data' => $model,
                'attributes' => array(
                    'coupon.act.id_act',
                    'coupon.act.name_act',
                    array(
                        'name' => 'coupon.act.id_town_act',
                        'value' => $model->coupon->act->town->name_towns,
                    ),
                    array(
                        'name' => 'coupon.act.id_themes_act',
                        'value' => $model->coupon->act->theme->name_themes,
                    ),
                    'coupon.act.price_old',
                    'coupon.act.price_new',
                    'coupon.act.coupon_count',
                    'coupon.act.coupon_purchased',
                    array(
                        'name' => 'coupon.act.is_bonus',
                        'value' => $model->coupon->act->is_bonus == 0 ? 'Нет' : 'Да',
                    ),
                    array(
                        'name' => 'coupon.act.date_start_act',
                        'value' => Yii::app()->dateFormatter->format('dd MMMM yyyy в HH:mm', $model->coupon->act->date_start_act),
                    ),
                    array(
                        'name' => 'coupon.act.date_end_act',
                        'value' => Yii::app()->dateFormatter->format('dd MMMM yyyy в HH:mm', $model->coupon->act->date_end_act),
                    ),
                    array(
                        'name' => 'coupon.act.date_end_coupon_act',
                        'value' => Yii::app()->dateFormatter->format('dd MMMM yyyy в HH:mm', $model->coupon->act->date_end_coupon_act),
                    ),
                    array(
                        'name' => 'coupon.act.terms',
                        'value' => nl2br($model->coupon->act->terms),
                        'type' => 'raw',
                    ),
                    array(
                        'name' => 'coupon.act.short_text_act',
                        'value' => nl2br($model->coupon->act->short_text_act),
                        'type' => 'raw',
                    ),
                ),
            ));
            ?>
        </div>
    </div>
</div>