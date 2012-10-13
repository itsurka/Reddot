<?php

/**
 * This is the model class for table "mailing".
 *
 * The followings are the available columns in table 'mailing':
 * @property integer $id
 * @property string $subject
 * @property string $body
 * @property integer $status
 * @property integer $type
 * @property integer $town_id
 * @property integer $recipientEmail
 * @property integer $created
 * @property integer $modified
 * @property integer $send_since_date
 */
class Mailing extends CActiveRecord {
    // Статусы расслки

    const STATUS_PENDING = 1;
    const STATUS_STARTED = 2;
    const STATUS_COMPLETED = 3;

    const TYPE_USERS = 'Пользователям';
    const TYPE_ORGANIZATIONS = 'Организациям';
    const TYPE_LOCAL_ADMINS = 'Локальным админам';
    const TYPE_ADMINS = 'Админам';

    public $statusListData = array(
        self::STATUS_PENDING => 'В ожидании',
        self::STATUS_STARTED => 'В обработке',
        self::STATUS_COMPLETED => 'Выполнен',
    );
    
    public $typesListData = array(
        User::ROLE_USER => self::TYPE_USERS,
        User::ROLE_ORG => self::TYPE_ORGANIZATIONS,
        User::ROLE_LOCALE_ADMIN => self::TYPE_LOCAL_ADMINS,
        User::ROLE_ADMIN => self::TYPE_ADMINS,
    );

    /**
     * Returns the static model of the specified AR class.
     * @param string $className active record class name.
     * @return Mailing the static model class
     */
    public static function model($className = __CLASS__) {
        return parent::model($className);
    }

    /**
     * @return string the associated database table name
     */
    public function tableName() {
        return 'mailing';
    }

    /**
     * @return array validation rules for model attributes.
     */
    public function rules() {
        // NOTE: you should only define rules for those attributes that
        // will receive user inputs.
        return array(
            array('subject, body, recipientEmail', 'required'),
            array('status, town_id, created, modified', 'numerical', 'integerOnly' => true),
            array('subject', 'length', 'max' => 255),
            array('type', 'length', 'max' => 255),
            array('recipientEmail', 'email'),
            // The following rule is used by search().
            // Please remove those attributes that should not be searched.
            array('id, subject, body, status, type, town_id, created, modified, send_since_date', 'safe', 'on' => 'search'),
        );
    }

    /**
     * @return array relational rules.
     */
    public function relations() {
        // NOTE: you may need to adjust the relation name and the related
        // class name for the relations automatically generated below.
        return array(
            'town' => array(self::BELONGS_TO, 'Town', 'town_id'),
        );
    }

    /**
     * @return array customized attribute labels (name=>label)
     */
    public function attributeLabels() {
        return array(
            'id' => 'ID',
            'subject' => 'Тема сообщения',
            'body' => 'Сообщение',
            'status' => 'Статус',
            'type' => 'Тип рассылки',
            'town_id' => 'Город',
            'recipientEmail' => 'E-mail получателя',
            'created' => 'Created',
            'modified' => 'Modified',
            'send_since_date' => 'Можно отправить начиная с этой даты',
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
        $criteria->compare('subject', $this->subject, true);
        $criteria->compare('body', $this->body, true);
        $criteria->compare('status', $this->status);
        $criteria->compare('type', $this->type);
        $criteria->compare('town_id', $this->town_id);
        $criteria->compare('recipientEmail', $this->recipientEmail);
        $criteria->compare('created', $this->created);
        $criteria->compare('modified', $this->modified);
        $criteria->compare('send_since_date', $this->send_since_date);

        return new CActiveDataProvider($this, array(
            'criteria' => $criteria,
        ));
    }

    public function beforeSave() {
        if (parent::beforeSave()) {
            if ($this->isNewRecord) {
                $this->created = time();
                if (empty($this->send_since_date))
                    $this->send_since_date = time();
            }

            $this->modified = time();
            return true;
        }
    }
}