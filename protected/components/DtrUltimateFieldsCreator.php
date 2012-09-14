<?php 
	class DtrUltimateFieldsCreator extends UltimateFieldsCreator{

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
	}
?>