<?php

/**
 * This is the model class for table "sale".
 *
 * The followings are the available columns in table 'sale':
 * @property integer $id
 * @property integer $start
 * @property integer $finish
 */
class Sale extends CActiveRecord {

    public $dateTemplate = 'Y-m-d H:i:s';
    private $_lastSale = null;

    /**
     * Returns the static model of the specified AR class.
     * @param string $className active record class name.
     * @return Sale the static model class
     */
    public static function model($className = __CLASS__) {
        return parent::model($className);
    }

    /**
     * @return string the associated database table name
     */
    public function tableName() {
        return 'sale';
    }

    /**
     * @return array validation rules for model attributes.
     */
    public function rules() {
        // NOTE: you should only define rules for those attributes that
        // will receive user inputs.
        return array(
            array('start, finish', 'required'),
            array('start, finish', 'numerical', 'integerOnly' => true),
            array('start', 'compare', 'operator' => '<', 'compareAttribute' => 'finish', 'message' => 'Дата начала должна быть меньше Даты окончания.'),
            // The following rule is used by search().
            // Please remove those attributes that should not be searched.
            array('id, start, finish', 'safe', 'on' => 'search'),
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
            'start' => 'Дата начала',
            'finish' => 'Дата окончания',
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
        $criteria->compare('start', $this->start);
        $criteria->compare('finish', $this->finish);

        return new CActiveDataProvider($this, array(
                    'criteria' => $criteria,
                ));
    }

    public function getLastSale() {

        if (!$this->_lastSale) {
            $criteria = new CDbCriteria();
            $criteria->order = 'start ASC';
            $criteria->condition = 'start > :start';
            $criteria->params = array(
                'start' => time(),
            );

            $this->_lastSale = self::model()->find($criteria);
        }


        return $this->_lastSale;
    }

    private function _timeToStr($attributes = array()) {
        foreach ($attributes as $attribute) {
            if ($this->{$attribute}) {
                $this->{$attribute} = date($this->dateTemplate, $this->{$attribute});
            }
        }
    }

    private function _srtTotime($attributes = array()) {
        foreach ($attributes as $attribute) {
            if (!is_int($this->{$attribute})) {
                $this->{$attribute} = strtotime($this->{$attribute});
            }
        }
    }

    public function afterFind() {
        parent::afterFind();
        $this->_timeToStr(array('start', 'finish'));
    }

    public function beforeValidate() {
        $this->_srtTotime(array('start', 'finish'));
        return parent::beforeValidate();
    }

    public function afterValidate() {
        parent::afterValidate();
        if ($this->hasErrors()) {
            $this->_timeToStr(array('start', 'finish'));
        }
    }

    public function getTimeLeft($outputType = 'array') {
        if (strtotime($this->start) < time())
            return false;

        $array = real_date_diff($this->start);
        $pos = array('г.', 'мес.', 'дн.', 'ч.', 'мин.', 'сек.');
        $result = '';

        for ($i = 0, $itemsCount = 0; $i < count($array); $i++) {
            if ($array[$i] == 0)
                continue;
            if ($itemsCount >= 4)
                break;

            if ($outputType == 'string') {
                $str .= "{$array[$i]} {$pos[$i]} ";
            } else {
                $result[] = "{$array[$i]} {$pos[$i]} ";
            }

            $itemsCount++;
        }

        return $result;
    }

}