<?php
/**
 * Реестр всех локальных и глобальных настроек хранящихся в БД (таблицы option и
 * option_value). По сути является реализацией паттерна Registry
 * @author Вольдэмар
 */
class Registry extends CApplicationComponent 
{
    private $_town_id;
    private $_town = NULL;
    
    public function setTown($town_id)
    {
        $town = Town::model()->findByPk($town_id);
        if ($town!==NULL)
            $this->_town_id = $town_id;
    }
    
    public function getTown()
    {
        if ($this->_town===NULL && Yii::app()->user->getTownId())
        {
            $this->_town = Town::model()->findByPk(Yii::app()->user->getTownId());
            return $this->_town;
        }
        return $this->_town;
    }
    
    public function init() 
    {
        $this->getTown();
        parent::init();
    }
    /**
     *получаем модель поля опции по названию
     * @param string $name
     * @return \Option 
     */
    private function getOptionByName($name)
    {
        return Option::model()->find(
                "name=:name",
                array(":name"=>$name)
        );
    }
    /**
     * @param integer $option_id
     * @return NULL|\OptionValue 
     */
    private function getOptionValue($option_id)
    {
        $option_value = OptionValue::model()->find(
                "option_id=:option_id AND towns_id=:towns_id",
                array(
                    ":option_id"=>$option_id,
                    ":towns_id"=>$this->_town->id_towns
                )
        );
        return $option_value;
    }
    
    private function getLocalOptionValue($option_id,$default_value)
    {
        $option_value = $this->getOptionValue($option_id);
        
        if ($option_value!==NULL)
            return $option_value->value;
        else 
            return $default_value;        
    }
    
    /**
     * получаем значение опции
     * @param string обозначение опции
     * @param bool является ли она глобальной, введено на тот случай, 
     * если имена глобальной и локальной переменной будут пересекаться
     * @return string|null 
     */
    public function getOption($name)
    {
        $option = $this->getOptionByName($name);
        if ($option)
            if ($option->type==Option::TYPE_GLOBAL)
                return $option->default_value;
            else
                return $this->getLocalOptionValue($option->id, $option->default_value);
            
        return NULL;
    }
    /**
     * задаем значение в глобальном списке опций
     * @param string название переменной
     * @param bool $global если задан флаг - то задаем значение для глобальной опции
     * @return bool
     */
    //TODO:протестировать работу, не используется пока
    /*
    public function setOption($name,$value)
    {
        $option = $this->getOptionByName($name);
        if ($option)
            if ($option->type==Option::TYPE_GLOBAL)
            {
                $option->default_value = $value;
                $option->save(false);
                return true;
            }
            else
            {
                $option_value = $this->getOptionValue($option->id);
                $option_value->value = $value;
                $option_value->save(false);
                return true;
            }
        else
            return false;
    }*/
}
?>
