<div class="themes filter_link type_themes">
    <?php if ($this->controller->action->id == 'map'): ?>
        <div id="map_ob_draggable" class="lf_menu_map_select">
            <div id="lf_menu_map_select_handle"></div>
        </div>
    <?php endif; ?>

    <ul class="themes_ul">
        <li class="type_themes_reset_all <?php echo (!isset($_GET['id_themes_act']) and !isset($_GET['tag']) and !isset($_GET['filter'])) ? 'active' : ''; ?>">
            <a href="<?php echo $this->getUrl(array(), true); ?>" id="resetAll">
                <span style="background-image:url('<?php echo Yii::app()->baseUrl; ?>/images/themes/all.png')" class="th_img"></span>  <span class="th_text">Все акции</span>
            </a>
        </li>
    </ul>
    <div class="l_col_headline">
        Темы:
    </div>
    <ul class="themes_ul">
        <?php foreach ($this->models as $model): ?>
            <li class="type_themes_<?php echo $model->id_themes; ?> <?php echo (isset($_GET['id_themes_act']) and $_GET['id_themes_act'] == $model->id_themes) ? 'active' : ''; ?>">
                <a href="<?php echo $this->getUrl(array('id_themes_act' => $model->id_themes)); ?>">
                    <span style="background-image:url('<?php echo Yii::app()->baseUrl; ?>/images/themes/all.png')" class="th_img"></span>
                    <span class="th_text"><?php echo $model->name_themes; ?></span>
                </a>
            </li>
        <?php endforeach; ?>
    </ul>
</div>