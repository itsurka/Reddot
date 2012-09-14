<?php
/* $this->widget('zii.widgets.CListView', array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
	'template'=>"{items}\n{pager}",
));
*/
//print_r($this->item);
foreach ($this->item as $key => $item) {
	//print_r($item);
//$item['name_act'];
$item['date_to_end'] = real_date_diff($item['date_end_act']);
echo CHtml::link($item['name_act'],array('/acts/view/'.$item['name_act'].'/'));
?>

<br><br>
<?=$item['short_text_act']?>
<br><br>
До завершения осталось <?=$item['date_to_end'][2]?> дней.<br><br><br><br>
<?
}
/*
echo $this->item['name_act'];
$this->item['date_to_end'] = real_date_diff($this->item['date_end_act']);
?>
<br><br>
<?=$this->item['short_text_act']?>
<br><br>
До завершения осталось <?=$this->item['date_to_end'][2]?> дней.
*/?>
