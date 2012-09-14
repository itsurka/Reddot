<?php

/**
 * This is the model class for table "option_value".
 *
 * The followings are the available columns in table 'option_value':
 * @property integer $id
 * @property integer $option_id
 * @property integer $towns_id
 * @property string $value
 *
 * The followings are the available model relations:
 * @property Towns $towns
 * @property Option $option
 */
class OptionValue extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return OptionValue the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}

	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'option_value';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('option_id, towns_id', 'required'),
			array('id, option_id, towns_id', 'numerical', 'integerOnly'=>true),
			array('value', 'length', 'max'=>255),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('id, option_id, towns_id, value', 'safe', 'on'=>'search'),
		);
	}

	/**
	 * @return array relational rules.
	 */
	public function relations()
	{
		// NOTE: you may need to adjust the relation name and the related
		// class name for the relations automatically generated below.
		return array(
                    'town' => array(self::BELONGS_TO, 'Town', 'towns_id'),
                    'option' => array(self::BELONGS_TO, 'Option', 'option_id'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => '#',
			'option_id' => 'Опция',
			'towns_id' => 'Привазанный город',
			'value' => 'Значение',
		);
	}

	/**
	 * Retrieves a list of models based on the current search/filter conditions.
	 * @return CActiveDataProvider the data provider that can return the models based on the search/filter conditions.
	 */
	public function search()
	{
		// Warning: Please modify the following code to remove attributes that
		// should not be searched.

		$criteria=new CDbCriteria;

		$criteria->compare('id',$this->id);
		$criteria->compare('option_id',$this->option_id);
		$criteria->compare('towns_id',$this->towns_id);
		$criteria->compare('value',$this->value,true);

                if (Yii::app()->user->role ==  User::ROLE_LOCALE_ADMIN)
                            $criteria->compare('towns_id', Yii::app()->user->getTownId(), true);
                
		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
}