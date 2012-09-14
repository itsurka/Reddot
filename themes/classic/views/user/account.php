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
                    <div class="options" style="height: 600px;">
					<div class="side-left">
						<div class="block gallery">
							<h2><?php echo $model->name; ?>' profile</h2>
							<div class="gallery-inner">
								<div class="foto">
									<?php echo $model->imageUrl('uploads/user/130x150/',array('class'=>'other-edit-profile-image')); ?>
								</div>
								<div class="other-account-details">
									<ul>
										<li><label>Name: </label><?php echo $model->name; ?></li>
										<?php if(!empty($model->birthday) && !preg_match('/\d\@(facebook.com|twitter.com)/', $model->email)): ?>
											<li><label>Birthday: </label><?php echo date('d F Y', $model->birthday); ?></li>
										<?php endif; ?>
										<?php if(!empty($model->city) && !preg_match('/\d\@(facebook.com|twitter.com)/', $model->email)): ?>
											<li><label>City: </label><?php echo $model->city; ?></li>
										<?php endif; ?>
										<li><label>Date of registration: </label><?php echo date('d F Y', $model->joindate); ?></li>
                                        <?php if(Yii::app()->user->role == 'client' || Yii::app()->user->role == 'admin'): ?>
										<li><label>Number of objects: </label><?php echo $model->ocount; ?></li>
                                        <?php endif; ?>
                                        <?php if(!preg_match('/\d\@(facebook.com|twitter.com)/', $model->email)): ?>
										<li><label>Comments: </label><a href="#comments"><?php echo $model->ccount; ?></a></li>
                                        <?php endif; ?>
									</ul>
								</div>
								<div class="clr"></div>
							</div>
						</div>
                        <?php if(!preg_match('/\d\@(facebook.com|twitter.com)/', $model->email)):?>
						<div class="block info">
							<div class="block-inner">
								<h3><a href="#comments">admin's comments (<?php echo $model->ccount; ?>)</a></h3>
								<?php $this->widget('zii.widgets.CListView',array(
									'dataProvider'=>$dataProvider,
									'itemView'=>'_commentItem',
									'summaryText'=>'',
                                    'emptyText'=>'You have no comments.',
								)); ?>
							</div>
						</div>
                        <?php endif; ?>
					</div>
                    <?php if(!preg_match('/\d\@(facebook.com|twitter.com)/', $model->email)):?>
					<div class="side-right">
						<div class="block about">
							<h2>About Me</h2>
							<div class="block-inner">
								<p><?php echo nl2br($model->about); ?></p>
							<!-- </div>
							<div class="block sports"> -->

							</div>
						</div>
                        <?php
                            //TODO change method on the RBAC
                            if(Yii::app()->user->role == 'client' || Yii::app()->user->role == 'admin'):
                        ?>
                        <div class="block specials">
                                <div class="block-inner tab active">
                                    <ul class="tabs">
                                	    <li class="site active">Objects</li>
                                		<li class="site">Events</li>
                                		<li class="site">Ads</li>
                                	</ul>
                                <div class="tab active">
                                    <?php echo $this->renderPartial('_object', array('model' => $model), true); ?>
                                </div>
                                <div class="tab">
                                    <?php echo $this->renderPartial('_event', array('model' => $model), true); ?>
                                </div>
                                <div class="tab">
                                    <?php echo $this->renderPartial('_advert', array('model' => $model), true); ?>
                                </div>
                               	</div>
                        <div>
                        <?php endif; ?>
					</div>
					<div class="clr"></div>
				</div>

			</div>
                    <?php endif; ?>
					</div>
		</div>
	        </div>
        </div>
    </div>