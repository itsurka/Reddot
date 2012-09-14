<?php

/**
 * This is the model class for table "coupon".
 *
 * The followings are the available columns in table 'coupon':
 * @property string $id
 * @property integer $act_id
 * @property string $title
 * @property string $total_cost
 * @property string $first_cost
 * @property string $last_cost
 * @property integer $discount
 * @property integer $created
 * @property integer $modified
 */
class Coupon extends CActiveRecord implements IECartPosition {

    /**
     * Returns the static model of the specified AR class.
     * @param string $className active record class name.
     * @return Coupon the static model class
     */
    public static function model($className = __CLASS__) {
        return parent::model($className);
    }

    /**
     * @return string the associated database table name
     */
    public function tableName() {
        return 'coupon';
    }

    /**
     * @return array validation rules for model attributes.
     */
    public function rules() {
        // NOTE: you should only define rules for those attributes that
        // will receive user inputs.
        return array(
            array('title, discount, total_cost', 'required'),
            array('act_id, discount, created, modified', 'numerical', 'integerOnly' => true),
            array('title', 'length', 'max' => 256),
            array('total_cost, first_cost, last_cost', 'length', 'max' => 32),
            // The following rule is used by search().
            // Please remove those attributes that should not be searched.
            array('id, act_id, title, total_cost, first_cost, last_cost, discount, created, modified', 'safe', 'on' => 'search'),
        );
    }

    /**
     * @return array relational rules.
     */
    public function relations() {
        // NOTE: you may need to adjust the relation name and the related
        // class name for the relations automatically generated below.
        return array(
            'act' => array(self::BELONGS_TO, 'Act', 'act_id'),
        );
    }

    /**
     * @return array customized attribute labels (name=>label)
     */
    public function attributeLabels() {
        return array(
            'id' => 'ID',
            'act_id' => 'Акия',
            'title' => 'Название купона',
            'total_cost' => 'Стоимость купона',
            'first_cost' => 'Изначальная цена',
            'last_cost' => 'Итоговая цена',
            'discount' => 'Скидка',
            'created' => 'Добавлен',
            'modified' => 'Изменен',
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
        $criteria->compare('act_id', $this->act_id);
        $criteria->compare('title', $this->title, true);
        $criteria->compare('total_cost', $this->total_cost, true);
        $criteria->compare('first_cost', $this->first_cost, true);
        $criteria->compare('last_cost', $this->last_cost, true);
        $criteria->compare('discount', $this->discount);
        $criteria->compare('created', $this->created);
        $criteria->compare('modified', $this->modified);

        return new CActiveDataProvider($this, array(
            'criteria' => $criteria,
        ));
    }

    public function getTitle() {
        if (!$this->title) {
            $this->act->name_act;
        } else {
            $this->title;
        }
    }

    public function getId() {
        return $this->id;
    }

    public function getPrice() {
        return $this->total_cost;
    }

}