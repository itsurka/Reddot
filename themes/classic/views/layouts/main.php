<?php $this->beginContent('/layouts/wrappers/'.(isset($wrapper)?$wrapper:'main')); ?>
	
	<div class="span-24 last" id="main">
		<?php $contentSpan = 24
			- isset($this->clips['sidebar']) * 6 ; ?>
		
		<div class="span-<?php echo $contentSpan; if(!isset($this->clips['sidebar'])){ ?> last<?php } ?>" id="content">
		<?php echo $this->clips['content']; echo $content; ?>
		</div><!-- content -->
		
		<?php if(isset($this->clips['sidebar'])) { ?>
		<div class="span-6 last" id="sidebar"><?php
		echo $this->clips['sidebar'];
		?></div><!-- sidebar -->
		<?php } ?>
		
	</div><!-- main -->
	
<?php $this->endContent(); ?>