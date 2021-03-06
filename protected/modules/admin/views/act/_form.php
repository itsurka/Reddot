<?php
$form = $this->beginWidget('CActiveForm', array(
    'id' => 'town-form',
    'enableAjaxValidation' => false,
    'htmlOptions' => array(
        'enctype' => 'multipart/form-data',
        'autocomplete' => 'off',
    )
));
?>
<?php Yii::app()->clientScript->registerScript('custom redactor', "
    var editor = CKEDITOR.replace('Act_full_text_act', {
        width: '730px',
        height: '490px',
        toolbar : [
            ['Source','-','Save','NewPage','Preview','-','Templates'],
            ['Cut','Copy','Paste','PasteText','PasteFromWord','-','Print', 'SpellChecker', 'Scayt'],
            ['Undo','Redo','-','Find','Replace','-','SelectAll','RemoveFormat'],
            ['Form', 'Checkbox', 'Radio', 'TextField', 'Textarea', 'Select', 'Button', 'ImageButton', 'HiddenField'],
            '/',
            ['Bold','Italic','Underline','Strike','-','Subscript','Superscript'],
            ['NumberedList','BulletedList','-','Outdent','Indent','Blockquote','CreateDiv'],
            ['JustifyLeft','JustifyCenter','JustifyRight','JustifyBlock'],
            ['BidiLtr', 'BidiRtl' ],
            ['Link','Unlink','Anchor'],
            ['Image','Flash','Table','HorizontalRule','Smiley','SpecialChar','PageBreak','Iframe'],
            '/',
            ['Styles','Format','Font','FontSize'],
            ['TextColor','BGColor'],
            ['Maximize', 'ShowBlocks','-','About']
        ]
    });
    CKFinder.setupCKEditor( editor, '/js/ckfinder/');

    CKEDITOR.replace('Act_terms', {
        width: '730px',
        height: '240px'
    });

    CKEDITOR.replace('Act_price_new_description', {
        width: '730px',
        height: '100px'
    });

"); ?>

<script type="text/javascript">

    function movePhoto(elem, direction)
    {
        var _elem = elem.clone();
        var pos = elem.index();

        console.log(elem);
        console.log(pos);


        var elements = $('#added_act_photo .added_act_photo');
        if (direction == 'up') {
            if (pos == 0)
                return false;

            elements.eq(pos-1).before(_elem);
            elem.remove();
        } else {
            if (pos+1 == elements.size())
                return false;

            elements.eq(pos+1).after(_elem);
            elem.remove();
        }
    }

</script>

<fieldset>
    <?php if ($act->hasErrors()): ?>
        <div class="alert alert-error">
            <?php echo CHtml::errorSummary(array($act)); ?>
        </div>
    <?php endif; ?>
    <div class="form-inline" style="margin-left: 160px;">
        <?php echo $form->dropDownList($act, 'id_town_act', array('' => 'Выберите город') + Town::model()->getTownsListData()); ?>
        <?php echo $form->dropdownList($act, 'id_org_act', array('' => 'Выберите организацию') + User::model()->getOrgListData()); ?>
        <?php echo $form->dropDownList($act, 'id_themes_act', array('' => 'Выберите тему') + Theme::model()->getThemeListData()); ?>
    </div>
    <div class="form-horizontal" style="margin-top: 20px;">
        <div class="control-group">
            <?php echo $form->labelEx($act, 'name_act', array('class' => 'control-label')); ?>
            <div class="controls">
                <?php echo $form->textField($act, 'name_act', array('class' => 'input-xxlarge')); ?>
            </div>
        </div>

        <div class="control-group">
            <?php echo $form->labelEx($act, 'short_url', array('class' => 'control-label')); ?>
            <div class="controls">
                <?php echo $form->textField($act, 'short_url', array('class' => 'input-xlarge')); ?>
            </div>
        </div>

        <div class="control-group">
            <div class="controls">
                <label class="checkbox">
                    <?php echo $form->checkBox($act, 'is_bonus'); ?>
                    Это бонусная акция
                </label>
            </div>
        </div>

        <div class="control-group">
            <?php echo $form->labelEx($act, 'short_text_act', array('class' => 'control-label')); ?>
            <div class="controls">
                <?php echo $form->textArea($act, 'short_text_act', array('class' => 'input-xxlarge')); ?>
            </div>
        </div>

        <div class="control-group">
            <?php echo $form->labelEx($act, 'full_text_act', array('class' => 'control-label')); ?>
            <div class="controls">
                <?php echo $form->textArea($act, 'full_text_act', array('class' => 'input-xxlarge ')); ?>
            </div>
        </div>

        <div class="control-group">
            <?php echo $form->labelEx($act, 'terms', array('class' => 'control-label')); ?>
            <div class="controls">
                <?php echo $form->textArea($act, 'terms', array('class' => 'input-xxlarge ')); ?>
            </div>
        </div>

        <div class="control-group">
            <?php echo $form->labelEx($act, 'photo_act', array('class' => 'control-label')); ?>
            <div class="controls" id="act_photo">
                <?php echo $form->fileField($act, 'photo_act', array('class' => 'input-xlarge')); ?>
            </div>
            <div class="controls" id="added_act_photo">
                <?php foreach($act->getAdditionalImages() as $eachImage): ?>
                    <div class="added_act_photo">
                        <?php echo CHtml::image($act->getAdditionalPictureWebPath("550x315", $eachImage), $eachImage, array('style'=>'width: 120px;')); ?>
                        <?php echo CHtml::hiddenField('added_act_photo[]', $eachImage); ?>
                        <span class="move_up" onclick="movePhoto($(this).parent(), 'up');"></span>
                        <span class="move_down" onclick="movePhoto($(this).parent(), 'down');"></span>
                        <span class="delete" onclick="$(this).parent().remove();"></span>
                    </div>
                    <?php  ?>
                <?php endforeach; ?>
            </div>
            <div class="controls" id="new_act_photo"></div>
            <div class="controls">
                <div style="margin-top: 20px;margin-bottom: 20px;">
                    <a href="#" class="addMorePhoto">Добавить ещё</a>
                </div>
            </div>
            <div style="display: none;" id="additional_image_template">
                <div class="additional_image">
                    <?php echo $form->fileField($act, 'additional_images[]'); ?>&nbsp;
                    <span class="delete" onclick="$(this).parent().remove();"></span>
                </div>
            </div>
        </div>

        <!--<div class="control-group">
            <?php /*echo $form->labelEx($act, 'delete_picture', array('class' => 'control-label')); */?>
            <div class="controls">
                <?php /*echo $form->checkBox($act, 'delete_picture'); */?>
            </div>
        </div>-->

        <label class="control-label required">
            Введите денежные и<br>скидочные<br>параметры<br>(текст слева от кнопки<br>Купить)
        </label>
<!--        <h3>Введите денежные и<br>скидочные<br>параметры<br>(текст слева от кнопки<br>Купить)</h3>-->
        <!--<p class="help-block">Тут будет содержаться описание этих текстовых полей...</p>-->

        <div class="control-group">
            <div class="controls">
                <?php echo $form->textArea($act, 'price_new_description', array('class' => '', 'placeholder' => 'Исходная цена, минус проценты, итоговая цена.')); ?>
            </div>
        </div>
        <div class="control-group">
            <div class="controls" style="margin-left: 0px;">
                <div style="margin-top: 0px; float: left; width: 143px; position: relative; padding-right: 17px;">
                    <p class="help-block" style="margin-top: 0px; text-align: right;">
                        Текст рядом с кнопкой КУПИТЬ на странице акции
                    </p>
                </div>
                <div>
                    <?php echo $form->textField($act, 'price_new', array('placeholder' => 'Можете указать цену')); ?>
                </div>
            </div>
        </div>
    </div>

    <h4>Создание денежных условий или купонов в акции</h4>
    <p class="help-block">При создании дополнительных строк ввода следующей информации &mdash; автоматически создаются купоны в акции</p>
    <hr />

    <!-- Шаблон для новых купонов -->
    <script type="text/plain" id="formItemTemplate">
        <div style="margin-top: 20px;">
            <b></b> <a href="#">удалить</a>
            <span style="display:block;">
                <?php echo CHtml::textField('Coupon[][title]', '', array('placeholder' => 'Введите название купона', 'style' => 'width: 435px;')); ?>
                <?php echo CHtml::textField('Coupon[][total_cost]', '', array('placeholder' => 'Стоимость купона')); ?> <br />
            </span>
            <span style="display:block;margin-top: 10px;">
                <?php echo CHtml::textField('Coupon[][first_cost]', '', array('placeholder' => 'Изначальная стоимость')); ?>
                <?php echo CHtml::textField('Coupon[][discount]', '', array('placeholder' => 'Размер скидки')); ?>
                <?php echo CHtml::textField('Coupon[][last_cost]', '', array('placeholder' => 'Итоговая цена')); ?>
            </span>
        </div>
    </script>
    <!-- Конец шаблона для новых купонов -->

    <?php Yii::app()->clientScript->registerScript('/act/_form', "
        function setCounts() {
            var items = $('#itemsList div');
            for(var i = 1; i <= items.length; i++) {
                $(items[i]).find('b').html((i + 1) + '.');
            }
        }

        $('#itemsList div a').live('click', function() {
            $(this).parent().remove();
            setCounts();

            return false;
        });

        $('.addMoreCoupons').click(function() {
            var count = $('#itemsList div').length;

            if(count < 10) {
                var template = $('#formItemTemplate').html();
                $('#itemsList').append(template);

                var inputs = $('#itemsList').find('div:last').find('input');
                for(var i = 0; i < inputs.length; i++) {
                    $(inputs[i]).attr('name', $(inputs[i]).attr('name').replace('[]', '[_' + count + ']'))
                }

                console.log($('#itemsList').find('div:last'));
                setCounts();
            }

            return false;
        });

        $('.addMorePhoto').click(function() {
            var count = $('#new_act_photo .additional_image').length;

            if(count < 10) {
                var template = $('#additional_image_template').html();
                $('#new_act_photo').append(template);
            }
            
            return false;
        });

    ");
    ?>
    <div class="form-inline" style="margin: 0px 0px 0px 160px;">
        <div id="itemsList">
            <?php $c = 0; ?>
            <?php foreach ($coupons as $i => $coupon): ?>
                <?php $id = isset($coupon->id) ? $coupon->id : $i; ?>
                <div style="margin-top: 20px;">
                    <b><?php echo $c + 1; ?>.</b> <a href="#"><?php echo ($c > 0) ? 'удалить' : ''; ?></a>
                    <?php if ($coupon->hasErrors()): ?>
                        <div class="alert alert-error">
                            <?php echo CHtml::errorSummary($coupon); ?>
                        </div>
                    <?php endif; ?>
                    <span style="display:block;">
                        <?php echo $form->textField($coupon, "[$id]title", array('placeholder' => 'Введите название купона', 'style' => 'width: 435px;')); ?>
                        <?php echo $form->textField($coupon, "[$id]total_cost", array('placeholder' => 'Стоимость купона')); ?> <br />
                    </span>
                    <span style="display:block;margin-top: 10px;">
                        <?php echo $form->textField($coupon, "[$id]first_cost", array('placeholder' => 'Изначальная стоимость')); ?>
                        <?php echo $form->textField($coupon, "[$id]discount", array('placeholder' => 'Размер скидки')); ?>
                        <?php echo $form->textField($coupon, "[$id]last_cost", array('placeholder' => 'Итоговая цена')); ?>
                    </span>
                </div>
                <?php $c++; ?>
            <?php endforeach; ?>
        </div>
        <div style="margin-top: 20px;margin-bottom: 20px;"><a href="#" class="addMoreCoupons">Добавить ещё</a></div>
    </div>
    <h4>Время действия акции</h4>
    <hr />

    <div class="form-horizontal">
        <div class="control-group">
            <?php echo $form->labelEx($act, 'coupon_count', array('class' => 'control-label')); ?>
            <div class="controls">
                <?php echo $form->textField($act, 'coupon_count'); ?>
            </div>
        </div>

        <div class="control-group">
            <?php echo $form->labelEx($act, 'date_start_act', array('class' => 'control-label')); ?>
            <div class="controls">
                <?php $this->widget('application.extensions.timepicker.timepicker', array('model' => $act, 'name' => 'date_start_act')); ?>
            </div>
        </div>

        <div class="control-group">
            <?php echo $form->labelEx($act, 'date_end_act', array('class' => 'control-label')); ?>
            <div class="controls">
                <?php $this->widget('application.extensions.timepicker.timepicker', array('model' => $act, 'name' => 'date_end_act')); ?>
            </div>
        </div>
        <div class="control-group">
            <?php echo $form->labelEx($act, 'date_end_coupon_act', array('class' => 'control-label')); ?>
            <div class="controls">
                <?php $this->widget('application.extensions.timepicker.timepicker', array('model' => $act, 'name' => 'date_end_coupon_act')); ?>
            </div>
        </div>

        <h4>Редактирование СЕО настроек</h4>
        <hr />

        <div class="control-group">
            <?php echo $form->labelEx($act, 'seo_title', array('class' => 'control-label')); ?>
            <div class="controls">
                <?php echo $form->textField($act, 'seo_title', array('class' => 'input-xxlarge')); ?>
            </div>
        </div>

        <div class="control-group">
            <?php echo $form->labelEx($act, 'seo_keywords', array('class' => 'control-label')); ?>
            <div class="controls">
                <?php echo $form->textArea($act, 'seo_keywords', array('class' => 'input-xxlarge')); ?>
            </div>
        </div>

        <div class="control-group">
            <?php echo $form->labelEx($act, 'seo_description', array('class' => 'control-label')); ?>
            <div class="controls">
                <?php echo $form->textArea($act, 'seo_description', array('class' => 'input-xxlarge')); ?>
            </div>
        </div>

        <h4>Показать/скрыть акцию</h4>
        <hr />
            
        <div class="control-group">
            <?php echo $form->labelEx($act, 'is_active', array('class' => 'control-label')); ?>
            <div class="controls">
                <?php echo $form->checkBox($act, 'is_active'); ?>
            </div>
        </div>

        <div class="form-actions">
            <?php echo CHtml::submitButton('Сохранить', array('class' => 'btn btn-primary')); ?>
            <a href="<?php echo Yii::app()->createUrl('admin/act'); ?>" class="btn">Вернуться назад</a>
        </div>
    </div>
</fieldset>
<?php $this->endWidget(); ?>