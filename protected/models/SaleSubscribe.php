<?php

/**
 * This is the model class for table "sale_subscribe".
 *
 * The followings are the available columns in table 'sale_subscribe':
 * @property integer $id
 * @property integer $sale_id
 * @property integer $user_id
 * @property string $email
 * @property integer $status
 */
class SaleSubscribe extends CActiveRecord {

    /**
     * Returns the static model of the specified AR class.
     * @param string $className active record class name.
     * @return SaleSubscribe the static model class
     */
    public static function model($className = __CLASS__) {
        return parent::model($className);
    }

    /**
     * @return string the associated database table name
     */
    public function tableName() {
        return 'sale_subscribe';
    }

    /**
     * @return array validation rules for model attributes.
     */
    public function rules() {
        // NOTE: you should only define rules for those attributes that
        // will receive user inputs.
        return array(
            array('sale_id, email', 'required'),
            array('sale_id, user_id, status', 'numerical', 'integerOnly' => true),
            array('email', 'email'),
            array('email', 'length', 'max' => 128),
            // The following rule is used by search().
            // Please remove those attributes that should not be searched.
            array('id, sale_id, user_id, email, status', 'safe', 'on' => 'search'),
        );
    }

    /**
     * @return array relational rules.
     */
    public function relations() {
        // NOTE: you may need to adjust the relation name and the related
        // class name for the relations automatically generated below.
        return array(
        );
    }

    /**
     * @return array customized attribute labels (name=>label)
     */
    public function attributeLabels() {
        return array(
            'id' => 'ID',
            'sale_id' => 'Sale',
            'user_id' => 'User',
            'email' => 'Email',
            'status' => 'Status',
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

        $criteria->compare('id', $this->id);
        $criteria->compare('sale_id', $this->sale_id);
        $criteria->compare('user_id', $this->user_id);
        $criteria->compare('email', $this->email, true);
        $criteria->compare('status', $this->status);

        return new CActiveDataProvider($this, array(
            'criteria' => $criteria,
        ));
    }

    public function isSubscribed() {
        $lastSale = Sale::model()->getLastSale();
        if ($lastSale) {
            if (Yii::app()->user->isGuest) {
                return Yii::app()->user->hasState('isSubscribed_' . $lastSale->id);
            }
            else {
                $criteria = new CDbCriteria();
                $criteria->condition = 'user_id = :user_id AND sale_id = :sale_id';
                $criteria->params = array(
                    ':user_id' => Yii::app()->user->id,
                    ':sale_id' => $lastSale->id,
                );

                return self::model()->exists($criteria);
            }
        }

        return false;
    }

}