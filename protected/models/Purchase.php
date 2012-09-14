<?php

/**
 * This is the model class for table "purchase".
 *
 * The followings are the available columns in table 'purchase':
 * @property string $id
 * @property integer $act_id
 * @property string $secret_key
 * @property integer $user_id
 * @property integer $operation_id
 * @property integer $status
 * @property integer $created
 * @property integer $modified
 */
class Purchase extends CActiveRecord {

    public $act_search = '';
    public $act_town_search = '';
    public $coupon_title_search = '';

    /**
     * Статусы покупок
     */

    const STATUS_NOT_ACTIVATED = 1; // Не активированна магазином
    const STATUS_ACTIVATED = 2; // Активирована магазином

    public $statusListData = array(
        self::STATUS_ACTIVATED => 'Активированные',
        self::STATUS_NOT_ACTIVATED => 'Не активированные',
    );

    /**
     * Returns the static model of the specified AR class.
     * @param string $className active record class name.
     * @return Purchase the static model class
     */
    public static function model($className = __CLASS__) {
        return parent::model($className);
    }

    /**
     * @return string the associated database table name
     */
    public function tableName() {
        return 'purchase';
    }

    /**
     * @return array validation rules for model attributes.
     */
    public function rules() {
        // NOTE: you should only define rules for those attributes that
        // will receive user inputs.
        return array(
            array('act_id', 'required'),
            array('act_id, user_id, operation_id, status, created, modified', 'numerical', 'integerOnly' => true),
            array('secret_key', 'length', 'max' => 9),
            array('picture', 'length', 'max' => 64),
            // The following rule is used by search().
            // Please remove those attributes that should not be searched.
            array('id, act_id, secret_key, user_id, operation_id, status, created, modified, act_search, coupon_title_search, act_town_search', 'safe', 'on' => 'search'),
        );
    }

    /**
     * @return array relational rules.
     */
    public function relations() {
        // NOTE: you may need to adjust the relation name and the related
        // class name for the relations automatically generated below.
        return array(
            'coupon' => array(self::BELONGS_TO, 'Coupon', 'act_id'),
            'user' => array(self::BELONGS_TO, 'User', 'user_id'),
            'town' => array(self::BELONGS_TO, 'Town', 'town_id'),
                //'operation' => array(self::BELONGS_TO, 'Operation', 'operation_id'),
        );
    }

    /**
     * @return array customized attribute labels (name=>label)
     */
    public function attributeLabels() {
        return array(
            'id' => 'ID',
            'act_id' => 'Act',
            'secret_key' => 'Код купона',
            'user_id' => 'User',
            'operation_id' => 'Operation',
            'act_search' => 'Название акции',
            'coupon_title_search' => 'Название купона',
            'act_town_search' => 'Город акции',
            'status' => 'Status',
            'created' => 'Created',
            'modified' => 'Modified',
        );
    }

    /**
     * Retrieves a list of models based on the current search/filter conditions.
     * @return CActiveDataProvider the data provider that can return the models based on the search/filter conditions.
     */
    public function userSearch() {
        // Warning: Please modify the following code to remove attributes that
        // should not be searched.

        $criteria = new CDbCriteria;
        $criteria->with = array('coupon', 'user');
        $criteria->compare('t.id', $this->id, true);
        $criteria->compare('t.act_id', $this->act_id);
        $criteria->compare('t.user_id', $this->user_id);
        $criteria->compare('t.operation_id', $this->operation_id);
        $criteria->compare('t.status', $this->status);
        $criteria->compare('t.secret_key', $this->secret_key, true);
        $criteria->compare('t.created', $this->created);
        $criteria->compare('t.modified', $this->modified);
        //  
        $criteria->compare('coupon.title', $this->act_search, true);
        $criteria->compare('coupon.act.id_town_act', $this->act_town_search, true);

        return new CActiveDataProvider($this, array(
                    'criteria' => $criteria,
                    'pagination' => array('pageSize' => 20),
                    'sort' => array(
                        'defaultOrder' => 't.id DESC',
                    )
                ));
    }

    /**
     * Retrieves a list of models based on the current search/filter conditions.
     * @return CActiveDataProvider the data provider that can return the models based on the search/filter conditions.
     */
    public function search() {
        // Warning: Please modify the following code to remove attributes that
        // should not be searched.

        $criteria = new CDbCriteria;
        $criteria->with = array('coupon', 'coupon.act', 'user');

        $criteria->compare('t.id', $this->id, true);
        $criteria->compare('t.act_id', $this->act_id);
        $criteria->compare('t.user_id', $this->user_id);
        $criteria->compare('t.operation_id', $this->operation_id);
        $criteria->compare('t.org_id', $this->org_id);
        $criteria->compare('t.status', $this->status);
        $criteria->compare('t.secret_key', $this->secret_key, true);
        $criteria->compare('t.created', $this->created);
        $criteria->compare('t.modified', $this->modified);
        //  
        $criteria->compare('coupon.title', $this->coupon_title_search, true);

        return new CActiveDataProvider($this, array(
                    'criteria' => $criteria,
                    'pagination' => array('pageSize' => 50),
                    'sort' => array(
                        'defaultOrder' => 't.id DESC',
                        'attributes' => array(
                            'coupon_title_search' => array(
                                'asc' => 'coupon.title',
                                'desc' => 'coupon.title DESC',
                            ),
                            '*',
                        ),
                    ),
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

    public function getUniqueKey() {
        $data = str_split('0123456789ABCDEFGHIJKLMNOPQRSTUVWXYZ', 1);
        $max = count($data) - 1;
        $str = '';

        for ($i = 0; $i < 9; $i++) {
            if ($i == 4) {
                $str .= '-';
                continue;
            }

            $str .= $data[mt_rand(0, $max)];
        }

        return $str;
    }

    public function getPictureFile() {
        $s = DIRECTORY_SEPARATOR;
        $rootPath = dirname(Yii::getPathOfAlias('application')) . $s;
        $imagePath = $rootPath . 'images' . $s . 'coupon.jpg';
        $uploadsPath = $rootPath . 'upload' . $s . 'coupons';
        $fontPath = $rootPath . 'fonts/13761.ttf';

        //if (true) {
        if (!$this->picture) {
            $this->picture = md5($this->secret_key) . '.jpg';

            if (!is_dir($uploadsPath)) {
                mkdir($uploadsPath);
            }

            $image = WideImage::load($imagePath);
            $canvas = $image->getCanvas();
            $canvas->useFont($fontPath, 48, $image->allocateColor(45, 152, 208));
            $canvas->writeText('center', 100, $this->secret_key);

            $imagePath = $uploadsPath . $s . $this->picture;
            $image->saveToFile($imagePath);

            $this->save();
        }

        return $uploadsPath . $s . $this->picture;
    }

}