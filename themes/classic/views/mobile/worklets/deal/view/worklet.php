<?php
$this->render('workletStd',array(
	'id' => $id,
	'title' => $title,
	'content' => $content,
	'toolbar' => array(
		'left' => array('label' => $this->t('Select City'), 'href' => '#wlt-LocationSelect',
			'class' => 'slide'),
		'right' => array('label' => $this->t('My Stuff'), 'href' => url('/deal/coupons'), 'class' => '')
	),
));