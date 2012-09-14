<?php

/**
 * This is the model class for table "page".
 *
 * The followings are the available columns in table 'page':
 * @property string $id
 * @property string $title
 * @property string $name
 * @property string $text
 * * @property string $type
 * @property integer $created
 * @property integer $modified
 */
class Page extends CActiveRecord {
    /**
     * Тип страницы
     */

    const TYPE_NEW = 1; // Новая страница
    const TYPE_EXISTS = 2; // Существующая страница

    /**
     * Доступные типы
     */

    public $availableTypes = array(
        self::TYPE_NEW => 'Новая страница',
        self::TYPE_EXISTS => 'Ссылка на существующую',
    );

    /**
     * Returns the static model of the specified AR class.
     * @param string $className active record class name.
     * @return Page the static model class
     */
    public static function model($className = __CLASS__) {
        return parent::model($className);
    }

    /**
     * @return string the associated database table name
     */
    public function tableName() {
        return 'page';
    }

    /**
     * @return array validation rules for model attributes.
     */
    public function rules() {
        // NOTE: you should only define rules for those attributes that
        // will receive user inputs.
        return array(
            array('title, name,  type', 'required'),
            array('created, modified, type', 'numerical', 'integerOnly' => true),
            array('title', 'length', 'max' => 128),
            array('text, seo_title, seo_keywords, seo_description', 'safe'),
            array('name', 'length', 'max' => 32),
            array('name', 'unique'),
            // The following rule is used by search().
            // Please remove those attributes that should not be searched.
            array('id, title, name, text, created, modified', 'safe', 'on' => 'search'),
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
            'title' => 'Название страницы',
            'name' => 'Ссылка ЧПУ',
            'text' => 'Содержание страницы',
            'created' => 'Дата создания',
            'modified' => 'Последнее изменение',
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
        $criteria->compare('title', $this->title, true);
        $criteria->compare('name', $this->name, true);
        $criteria->compare('text', $this->text, true);
        $criteria->compare('created', $this->created);
        $criteria->compare('modified', $this->modified);

        return new CActiveDataProvider($this, array(
            'criteria' => $criteria,
        ));
    }

    public function beforeSave() {
        if (parent::beforeSave()) {
            if ($this->isNewRecord) {
                $this->created = time();
            }

            $this->modified = time();
            return true;
        }
    }

    public function getName() {
        if ($this->type == self::TYPE_NEW)
            return 'page/' . $this->name;
        else if (self::TYPE_EXISTS)
            return $this->name;
    }

}