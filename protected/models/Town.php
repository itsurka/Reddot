<?php

class Town extends CActiveRecord {
    /**
     * The followings are the available columns in table 'tbl_user':
     * @var integer $id
     * @var string $username
     * @var string $password
     * @var string $salt
     * @var string $email
     * @var string $profile
     */

    /**
     * Returns the static model of the specified AR class.
     * @return CActiveRecord the static model class
     */
    public static function model($className = __CLASS__) {
        return parent::model($className);
    }

    /**
     * @return string the associated database table name
     */
    public function tableName() {
        return 'towns';
    }

    /**
     * @return array validation rules for model attributes.
     */
    public function rules() {
        // NOTE: you should only define rules for those attributes that
        // will receive user inputs.
        return array(
            array('name_towns', 'required'),
            array('description', 'safe'),
            array('id_towns, description, name_towns', 'safe', 'on' => 'search'),
        );
    }

    /**
     * @return array relational rules.
     */
    public function relations() {
        // NOTE: you may need to adjust the relation name and the related
        // class name for the relations automatically generated below.
        return array(
        //'posts' => array(self::HAS_MANY, 'Post', 'author_id'),
        );
    }

    /**
     * @return array customized attribute labels (name=>label)
     */
    public function attributeLabels() {
        return array(
            'id' => 'Id',
            'id_towns' => 'ID',
            'name_towns' => 'Название города',
            'description'=>'Контактная информация',
        );
    }

    public function getTownName($id) {
        $temp = Yii::app()->db->createCommand()
        ->select('*')
        ->from('towns')
        ->where('id_towns=:id', array(':id' => $id))
        ->query()
        ->read();

        return $temp['name_towns'];
    }

    public function getTownsListData() {
        return CHtml::listData(self::model()->findAll(), 'id_towns', 'name_towns');
    }

    /**
     * Retrieves a list of models based on the current search/filter conditions.
     * @return CActiveDataProvider the data provider that can return the models based on the search/filter conditions.
     */
    public function search() {
        // Warning: Please modify the following code to remove attributes that
        // should not be searched.

        $criteria = new CDbCriteria;

        $criteria->compare('id_towns', $this->id_towns);
        $criteria->compare('name_towns', $this->name_towns, true);

        return new CActiveDataProvider($this, array(
            'criteria' => $criteria,
        ));
    }

    public function getDescription() {
        return self::model()->findByPk(Yii::app()->user->getTown()->id_towns)->description;
    }

}