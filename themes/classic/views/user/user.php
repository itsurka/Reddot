<?php
Yii::app()->clientScript->registerScript('object/edit/info',
"
function publish(elem) {
    $.post(
        $(elem).attr('href'),
        {
            '". Yii::app()->request->csrfTokenName. "':'". Yii::app()->request->csrfToken ."',
        },
        function(data, status) {
            $(elem).html(data);
        }
    );
}
", CClientScript::POS_END);
?>
<div class="main">
    <div class="content">
        <div class="profile">
            <?php if(Yii::app()->user->id === $model->id): ?>
            <div class="heading">
                <?php $this->widget('application.components.widgets.AccountMenuWidget', array('model' => $model, 'action' => $this->action->id)); ?>
            </div>
            <?php endif; ?>
            <div class="heading-separator">
                <?php if(Yii::app()->user->id === $model->id): ?>
                <?php
                $class = $this->action->id == 'edit' ? 'active' : '';
                echo CHtml::link('<span>Edit profile</span>', Yii::app()->createUrl('user/edit'), array('class' => $class));
                ?>
                <?php endif; ?>
            </div>
            <div class="profile-inner">
                <div class="client-main-block">
                    <div class="img-clients">
                        <?php echo $model->imageUrl('uploads/user/130x150/',array('class'=>'other-edit-profile-image')); ?>
                    </div>
                    <div class="client-main-right">
                        <p class="name-client"><span><?php echo $model->name; ?></span> <br /> <?php echo ucfirst($model->city) ?> <br /> Member Since: <?php echo ucfirst(Yii::app()->getLocale(Yii::app()->language)->dateFormatter->format('MMMM yyyy', $model->joindate)) ?></p>
                        <p class="about-client"><strong>About:</strong> <br /><?php echo nl2br($model->about); ?></p>
                    </div>
                    <div class="clr"></div>
                </div>
                <div class="profile-client-block">
                    <div class="profile-client-box-left">
                        <ul>
                            <li> <img src="<?php echo Yii::app()->theme->baseUrl; ?>/images/ico-l-1.gif" alt="" />VIEW<span class="count"><?php echo ($model->getCountViews()) ? $model->getCountViews() : 0; ?></span></li>
                            <li> <img src="<?php echo Yii::app()->theme->baseUrl; ?>/images/ico-l-8.gif" alt="" />Likes<span class="count"><?php echo ($model->getCountLikes()) ? $model->getCountLikes() : 0; ?></span></li>
                            <li class="raiting"> <img src="<?php echo Yii::app()->theme->baseUrl; ?>/images/ico-l-11.gif" alt="" />Rating<div class="rating-box"><span style="width:65px;" class="star">&nbsp;</span></div></li>
                            <li> <img src="<?php echo Yii::app()->theme->baseUrl; ?>/images/ico-l-12.gif" alt="" />Comments<span class="count"><?php echo $model->ccount; ?></span></li>
                            <li> <img src="<?php echo Yii::app()->theme->baseUrl; ?>/images/ico-l-7.gif" alt="" />FAcebook<span class="count"><?php echo ($model->getCountFacebook()) ? $model->getCountFacebook() : 0; ?></span></li>
                            <li> <img src="<?php echo Yii::app()->theme->baseUrl; ?>/images/ico-l-9.gif" alt="" />Twitter<span class="count"><?php echo ($model->getCountTwitter()) ? $model->getCountTwitter() : 0; ?></span></li>
                            <li> <img src="<?php echo Yii::app()->theme->baseUrl; ?>/images/ico-l-10.gif" alt="" />Checkins<span class="count"><?php echo ($model->getCountCheckins()) ? $model->getCountCheckins() : 0; ?></span></li>
                        </ul>
                        <div class="module module-comments2">
                            <h3>COMMENTS</h3>
                            <div class="comments-box">
                                <?php $this->widget('zii.widgets.CListView',array(
                                'dataProvider'=>$dataProvider,
                                'itemView'=>'_commentItem',
                                'summaryText'=>'',
                                'emptyText'=>'You have no comments.',
                            )); ?>
                            </div>
                        </div>
                    </div>
                    <div class="profile-client-box-right">
                        <h2>RECENTLY VIEWED</h2>
	                    <?php $this->widget('application.components.widgets.LatestUserWidget', array('model' => $model)); ?>
                        <br />
                        <h2>LIKED LOCATIONS</h2>
	                    <?php $this->widget('application.components.widgets.LatestObjectWidget', array('model' => $model)); ?>
                    </div>
                    <div class="clr"></div>
                </div>
            </div>

        </div>

    </div>
</div>