<?php

/**
 * This is the model class for table "option".
 *
 * The followings are the available columns in table 'option':
 * @property integer $id
 * @property string $name
 * @property string $title
 * @property string $default_value
 * @property string $type
 *
 * The followings are the available model relations:
 * @property OptionValue[] $optionValues
 */
class Option extends CActiveRecord
{
        const TYPE_GLOBAL = 'global';
        const TYPE_LOCAL  = 'local';
        
        public function getOptionTypes()
        {
            return array(self::TYPE_GLOBAL=>'Глобальная',self::TYPE_LOCAL=>'Локальная');
        }
        
        public function getOptionName()
        {
            $types = $this->getOptionTypes();
            return $types[$this->type];
        }
        
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return Option the static model class
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
		return 'option';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('name, title, default_value', 'required'),
			array('name', 'length', 'max'=>50),
			array('title, default_value', 'length', 'max'=>255),
			array('type', 'length', 'max'=>6),
                        array('name','unique'),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('id, name, title, default_value, type', 'safe', 'on'=>'search'),
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
			'optionValues' => array(self::HAS_MANY, 'OptionValue', 'option_id'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => '№',
			'name' => 'Строка-обозначение',
			'title' => 'Человекочитаемое название',
			'default_value' => 'Дефолтное значение',
			'type' => 'Тип',
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
		$criteria->compare('name',$this->name,true);
		$criteria->compare('title',$this->title,true);
		$criteria->compare('default_value',$this->default_value,true);
		$criteria->compare('type',$this->type,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

    public static function getWebsiteUrl($withProtocol=true)
    {
        $protocol = 'http://';
        $url = self::getByName('website_url');
        if ($withProtocol)
        {
            if (strpos($url, $protocol)===false)
                $url = $protocol.$url;
        }
        else 
        {
            if (strpos($url, $protocol)!==false)
                $url = str_replace($protocol, '', $url);
        }

        return $url;
    }

    public static function getPreparedUrl($url, $withProtocol=true)
    {
        $protocol = 'http://';
        if ($withProtocol)
        {
            if (strpos($url, $protocol)===false)
                $url = $protocol.$url;
        }
        else
        {
            if (strpos($url, $protocol)!==false)
                $url = str_replace($protocol, '', $url);
        }

        return $url;
    }

    public static function getByName($name)
    {
        $return = '';
        $model = self::model()->findByAttributes(array('name' => $name));
        if ($model)
            $return = $model->default_value;
        
        return $return;
    }

    public static function getWebsiteLink()
    {
        return CHtml::link(self::getWebsiteUrl(false), self::getWebsiteUrl());
    }

    public static function getCompanyName()
    {
        return self::getByName('company_name');
    }

    public static function getCompanyLink()
    {
        return CHtml::link(self::getPreparedUrl(self::getByName('company_url'), false), self::getPreparedUrl(self::getByName('company_url'), true));
    }
}