<? foreach ($this->items as $key => $item) {?>
	<?=CHtml::link($item['name_act'],array('/'.$item['short_url'].'/'));?>
	<br><br>
	<?=$item['short_text_act']?>
	<br><br>
	До завершения осталось <?=$item['date_to_end'][2]?> дней.<br><br><br><br>
<?}?>