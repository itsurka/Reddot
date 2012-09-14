<?php 
	class UltimateFieldsCreator {
		public $model;
		public $form;
		public $controller;
		public $listval;

		public $fields;
		public $msg = array('CHOOSE'=>'Выберите');


		function UltimateFieldsCreator($model,$form,$controller){
			$this->model=$model;
			$this->form = $form;
			$this->controller = $controller;
			$this->init();
		}
		public function init(){
			$this->fields = $this->model->typeof();
			
			$typoflistval = array();
			foreach ($this->fields AS $type) {
				if ($type['table']!='')
					$typoflistval[ $type['table'] ] = array( 'fid'=>$type['fid'], 'fval'=>$type['fval'] );
			}
			//$this->listval=array_unique($typoflistval);


			$typofval = array();
			foreach ($typoflistval AS $table => $fields) {
				$rows = Yii::app()->db->createCommand()
						->select($fields['fid'].' AS fid, '.$fields['fval'].' AS fval')
						->from($table)
						->query()
						->readAll();
				foreach ($rows AS $row) 
					$typofval[ $table][ $row['fid'] ] = $row['fval'];
			}
			$this->listval = $typofval;
			
		}

		public function make($input_name,$prefix){

			echo $this->form->labelEx($this->model,$input_name); 
			
			switch ($this->fields[$input_name]['type']){
				case 'dropdownlist':///////////////////////////////////////////////////////////////////////////////////////////////////
					if ( empty($this->fields[$input_name]['table']) ) {
						echo $this->form->dropDownList( 
							$this->model, 
							$input_name, 
							$this->fields[$input_name]['values'], 
							array() 
						);
					} elseif(sizeof($this->listval[$this->fields[$input_name]['table']])>0)
							echo $this->form->dropDownList( $this->model, $input_name, $this->listval[$this->fields[$input_name]['table']], array() );
						else
							$this->error(404);
					break;
				case 'textarea'://////////////////////////////////////////////////////////////////////////////////////////////////////
					echo $this->form->textArea($this->model,	$input_name); 
					break;
				case 'multidropdownlist_outer':
				case 'multidropdownlist':
					$selected = array();
					//echo $input_name;
					//print_r($this->model->users);
					if ( sizeof($this->model->$input_name)>0 )
						foreach($this->model->$input_name AS $id) 
							$selected[$id]=array('selected'=>'selected');
					echo $this->form->dropDownList( $this->model, $input_name, $this->listval[$this->fields[$input_name]['table']], 
							array(
								'multiple' => 'multiple',
								'options' => $selected )
						);
					break;
				case 'date'://////////////////////////////////////////////////////////////////////////////////////////////////////////
					$this->controller->beginWidget('jQueryDataPicker',array('selector'=>'#'.$prefix.'_'.$input_name));$this->controller->endWidget();
				default:
					echo $this->form->textField($this->model,	$input_name); 
			}
			echo $this->form->error($this->model,		$input_name); 
		}

		public function error($code) {
			switch ($code) {
				case 404:
					echo 'Данные не найдены';
					break;
				
				default:
					echo 'Неизвестная ошибка';
					break;
			}
		}
	}
?>