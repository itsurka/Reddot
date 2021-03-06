<?php

/**
 * This is the model class for table "themes".
 *
 * The followings are the available columns in table 'themes':
 * @property integer $id_themes
 * @property string $name_themes
 * @property string $l_name_themes
 * @property string $ico_themes
 */
class Theme extends CActiveRecord {

    /**
     * Returns the static model of the specified AR class.
     * @param string $className active record class name.
     * @return Theme the static model class
     */
    public static function model($className = __CLASS__) {
        return parent::model($className);
    }

    /**
     * @return string the associated database table name
     */
    public function tableName() {
        return 'themes';
    }

    /**
     * @return array validation rules for model attributes.
     */
    public function rules() {
        // NOTE: you should only define rules for those attributes that
        // will receive user inputs.
        return array(
            array('name_themes', 'required'),
            array('name_themes, l_name_themes, ico_themes', 'length', 'max' => 255),
            // The following rule is used by search().
            // Please remove those attributes that should not be searched.
            array('id_themes, name_themes, l_name_themes, ico_themes', 'safe', 'on' => 'search'),
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
            'id_themes' => 'Id',
            'name_themes' => 'Название темы',
            'l_name_themes' => 'L Name Themes',
            'ico_themes' => 'Картинка',
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

        $criteria->compare('id_themes', $this->id_themes);
        $criteria->compare('name_themes', $this->name_themes, true);
        $criteria->compare('l_name_themes', $this->l_name_themes, true);
        $criteria->compare('ico_themes', $this->ico_themes, true);

        return new CActiveDataProvider($this, array(
            'criteria' => $criteria,
        ));
    }

    public function getThemeListData() {
        return CHtml::listData(Theme::model()->findAll(array('order' => 'id_themes ASC')), 'id_themes', 'name_themes');
    }

}