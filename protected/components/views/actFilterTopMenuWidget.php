<div class="mn2_block filter_link type_top_menu">
    <?php if ($this->controller->action->id != 'archive'): ?>
        <div class="type_top_menu_new mn2<?php echo (isset($_GET['filter']) and $_GET['filter'] == 'new') ? '_act' : ''; ?>">
            <table cellpadding="0" cellspacing="0" border="0">
                <tr>
                    <td class="lf"></td>
                    <td class="cn">
                        <a href="<?php echo $this->getUrl(array('filter' => 'new')); ?>">Новые</a>
                    </td>
                    <td class="rg"></td>
                </tr>
            </table>
        </div>
    <?php endif; ?>
    <div class="type_top_menu_top mn2<?php echo (isset($_GET['filter']) and $_GET['filter'] == 'top') ? '_act' : ''; ?>">
        <table cellpadding="0" cellspacing="0" border="0">
            <tr>
                <td class="lf"></td>
                <td class="cn">
                    <a href="<?php echo $this->getUrl(array('filter' => 'top')); ?>">ТОП-акции</a>
                </td>
                <td class="rg"></td>
            </tr>
        </table>
    </div>
    <?php foreach (ActTag::model()->findAll() as $model): ?>
        <div class="type_top_menu_<?php echo $model->id_tag; ?> mn2<?php echo (isset($_GET['filter']) and $_GET['filter'] == $model->id_tag) ? '_act' : ''; ?>">
            <table cellpadding="0" cellspacing="0" border="0">
                <tr>
                    <td class="lf"></td>
                    <td class="cn">
                        <a href="<?php echo $this->getUrl(array('filter' => $model->id_tag)); ?>">
                            <?php echo $model->title; ?>
                        </a>
                    </td>
                    <td class="rg"></td>
                </tr>
            </table>
        </div>        
    <?php endforeach; ?>
    <?php if (!Yii::app()->user->isGuest): ?>
        <div class="type_top_menu_fav mn2<?php echo (isset($_GET['filter']) and $_GET['filter'] == 'fav') ? '_act' : ''; ?>">
            <table cellpadding="0" cellspacing="0" border="0">
                <tr>
                    <td class="lf"></td>
                    <td class="cn">
                        <a href="<?php echo $this->getUrl(array('filter' => 'fav')); ?>" class="mn2_block_ico" style="background: url('<?php echo Yii::app()->baseUrl; ?>/images/ico_favor.png');"></a>
                        <a href="<?php echo $this->getUrl(array('filter' => 'fav')); ?>">Избранное</a>
                    </td>
                    <td class="rg"></td>
                </tr>
            </table>
        </div>
    <?php endif; ?>
</div>