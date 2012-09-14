<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of CreateUpdateActiveRecord
 *
 * @author Вольдэмар
 */
abstract class CreateUpdateActiveRecord extends CActiveRecord
{
    protected function beforeValidate() 
    {
        die("123123123");
        $this->update_date = new CDbExpression("NOW()");
        $this->update_user = Yii::app()->user->id;
        
        if ($this->isNewRecord)
        {
            $this->create_date = new CDbExpression("NOW()");
            $this->create_user = Yii::app()->user->id;
        }
        parent::beforeValidate();
    }
}

?>
