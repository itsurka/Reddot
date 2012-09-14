<?php

/**
 * This is the model class for table "users_address".
 *
 * The followings are the available columns in table 'users_address':
 * @property string $id
 * @property string $address
 * @property integer $user_id
 */
class UsersAddress extends CActiveRecord {

    /**
     * Шаблона для адресов компании
     * @var type 
     */
    // Россия, г. Москва, ул. Ленина, д. 36
    public $addressPattern = '|^[а-яА-Я-]+, г. [а-яА-Я-]+, ул. [а-яА-Я-]+, д. [а-яА-Я0-9-]+|ui';
    public $addressList = array();

    /**
     * Returns the static model of the specified AR class.
     * @param string $className active record class name.
     * @return UsersAddress the static model class
     */
    public static function model($className = __CLASS__) {
        return parent::model($className);
    }

    /**
     * @return string the associated database table name
     */
    public function tableName() {
        return 'users_address';
    }

    /**
     * @return array validation rules for model attributes.
     */
    public function rules() {
        // NOTE: you should only define rules for those attributes that
        // will receive user inputs.
        return array(
//            array('address', 'required'),
            array('addressList', 'required'),
            array('user_id', 'numerical', 'integerOnly' => true),
            array('address', 'length', 'max' => 255),
            //array('address', 'match', 'pattern' => $this->addressPattern, 'allowEmpty' => true, 'message' => 'Адрес не соответствует шаблону'),
            // The following rule is used by search().
            // Please remove those attributes that should not be searched.
            array('id, address, user_id', 'safe', 'on' => 'search'),
        );
    }

    /**
     * @return array relational rules.
     */
    public function relations() {
        // NOTE: you may need to adjust the relation name and the related
        // class name for the relations automatically generated below.
        return array(
            'user' => array(self::BELONGS_TO, 'User', 'user_id'),
        );
    }

    /**
     * @return array customized attribute labels (name=>label)
     */
    public function attributeLabels() {
        return array(
            'id' => 'ID',
            'address' => 'Адрес',
            'user_id' => 'User',
        );
    }

    /**
     * Retrieves a list of models based on the current search/filter conditions.
     * @return CActiveDataProvider the data provider that can return the models based on the search/filter conditions.
     */
    public function search() {
        // Warning: Please modify the following code to remove attributes that
        // should not be searched.

        $criteria = new CDbCriteria;

        $criteria->compare('id', $this->id, true);
        $criteria->compare('address', $this->address, true);
        $criteria->compare('user_id', $this->user_id);

        return new CActiveDataProvider($this, array(
            'criteria' => $criteria,
        ));
    }

}
