<?php

/**
 * @property $id
 * @property $username
 * @property $soc_uid
 * @property $soc_network
 * @property $first_name
 * @property $last_name
 * @property $address array
 * @property $town Town
 * @property $email
 * @property $password
 * @property $website
 * @property $role
 * @property $id_towns_user
 */
class User extends CActiveRecord {
    /**
     * роли пользователей на сайте 
     */

    const ROLE_ADMIN = 'administrator';
    const ROLE_ORG = 'organisation';
    const ROLE_LOCALE_ADMIN = 'locale_administrator';
    const ROLE_USER = 'user';

    public $roleListData = array(
        self::ROLE_ADMIN => 'Админ',
        self::ROLE_LOCALE_ADMIN => 'Локальный админ',
        self::ROLE_ORG => 'Организация',
        self::ROLE_USER => 'Пользователь',
    );

    /** Подписка */
    private $subscribe = null;

    /** @var string поле для подтверждения пароля при сохранении/редактировании */
    public $password2;
    public $initialPassword;
    public $delete_avatar;
    public $rememberMe = true;
    public $passwordConfirm;
    public $passwordNew;
    public $confirm;
    public $addressList = array();

    /**
     * Шаблона для адресов компании
     * @var type 
     */
    // Россия, г. Москва, ул. Ленина, д. 36
    public $addressPattern = '|^г. [а-яА-Я-]+, ул. [а-яА-Я-]+, д. [а-яА-Я0-9-]+|ui';

    /**
     * тип присылаемого уведомления 
     */

    const NOTIFY_TYPE_NONE = "None";
    const NOTIFY_TYPE_DIGEST = "Digest";
    const NOTIFY_TYPE_INSTANT = "Instant";
    const NOTIFY_TYPE_THRESHOLD = "Threshold";


    /**
     * активен/неактивен пользователь 
     */
    const USER_ACTIVE = "Y";
    const USER_INACTIVE = "N";

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
        return 'users';
    }

    /**
     * @return array validation rules for model attributes.
     */
    public function rules() {
// NOTE: you should only define rules for those attributes that
// will receive user inputs.
        return array(
            array('username, password, password2, email, role, notifyType', 'required', 'on' => 'insert'),
            array('password2', 'compare', 'compareAttribute' => 'password', 'on' => 'insert'),
            array('username, phone, working_time, password, password2,'
                . 'active,company_name,email,notifyType,id_towns_user,'
                . 'delete_avatar, avatar,first_name,last_name,avatar,compay_name,website', 'safe'),
            array('addressList', 'checkPattern'),
            array('password, password2', 'length', 'min' => 6),
            array('password, email', 'required', 'on' => 'register, login'),
            array('avatar', 'file', 'types' => 'jpg, gif, png', "allowEmpty" => TRUE),
//            array('username, email', 'unique'),
//            array('email, username', 'unique'),
            array('email', 'unique', 'on' => 'register,update'),
            array('email', 'email'),
            //array('website', 'safe'),
            /*
             * В профиле компании можно указывать больше одного телефона
             * Необходимо добавить новое поле mobile, для обычных пользователей
             */
            //array( 'phone', 'length', 'min'=>10, 'max'=> 25 ),
            //array( 'phone', 'match', 'pattern'=>'/^([+]?[0-9 -]+)$/' ),
            array('subscribe', 'boolean'),
            array('profile, subscribe', 'safe'),
            array('id, username, role, id_towns_user, active', 'safe', 'on' => 'search'),
        );
    }

    public function checkPattern() {
        if ($this->role === 'organization') {
            foreach ($this->addressList as $item) {
                if (!preg_match($this->addressPattern, $item['address'])) {
                    $this->addError('address', 'Адрес не соответствует шаблону');
                    break;
                }
            }
        }
    }

    /**
     * типы оповещения пользователя
     * @return array 
     */
    public static function getNotifyTypes() {
        return array(
            self::NOTIFY_TYPE_INSTANT => "Мгновенные",
            self::NOTIFY_TYPE_DIGEST => "Дайджест",
            self::NOTIFY_TYPE_THRESHOLD => "Порог уведомления",
            self::NOTIFY_TYPE_NONE => "Нет",
        );
    }

    /**
     * @return array relational rules.
     */
    public function relations() {
        // NOTE: you may need to adjust the relation name and the related
        // class name for the relations automatically generated below.
        return array(
            "town" => array(self::BELONGS_TO, 'Town', 'id_towns_user'),
            'address' => array(self::HAS_MANY, 'UsersAddress', 'user_id'),
        );
    }

    /**
     * @return array customized attribute labels (name=>label)
     */
    public function attributeLabels() {
        return array(
            'id' => '#',
            'avatar' => 'Фотография',
            'username' => 'Отображаемое имя',
            'password' => 'Пароль',
            'password2' => 'Повторите пароль',
            'first_name' => 'Имя',
            'last_name' => 'Фамилия',
            'company_name' => 'Название компании',
            'salt' => 'Salt',
            'id_towns_user' => 'Город',
            'createtime' => 'Дата регистрации',
            'lastvisit' => 'Заходил',
            'email' => 'Эл. почта',
            'profile' => 'Профиль',
            'role' => 'Группа пользователя',
            'active' => 'Активность',
            'working_time' => 'Рабочее время',
            'phone' => 'Телефон',
            'website' => 'Веб сайт',
            'rememberMe' => 'Запомнить меня',
            'subscribe' => 'Подписаться на рассылку',
            'addressList' => 'Адрес',
        );
    }

    public function safeAttributes() {
        return array(
            'login',
            'password',
            'password2',
        );
    }

    /**
     * Checks if the given password is correct.
     * @param string the password to be validated
     * @return boolean whether the password is valid
     */
    public function validatePassword($password) {
        return $this->hashPassword($password, $this->salt) === $this->password;
    }

    /**
     * Generates the password hash.
     * @param string password
     * @return string hash
     */
    public static function hashPassword($password) {
        return md5($password);
    }

    /**
     * Generates a salt that can be used to generate a password hash.
     * @return string the salt
     */
    protected function generateSalt() {
        return uniqid('', true);
    }

    public function getTownName($id = 0) {
        $townObj = Town::model()->findByPk($id);
        $town = 'Другой город';
        if (null !== $townObj) {
            $town = $townObj->name_towns;
        }
        return $town;
    }

    public function getTownId() {
        $town = 0;
        if (!Yii::app()->user->isGuest) {
            /** @var $user User */
            $town = $this->id_towns_user;
//            $user = $this->model()->findByPk( Yii::app()->user->getId() );
//            if ( null !== $user ) {
//                $town = $user->id_towns_user;
//            }
        } elseif (isset(Yii::app()->request->cookies['town'])) {
            $town = Yii::app()->request->cookies['town']->value;
        }
        return $town;
    }

    public function search() {
        $criteria = new CDbCriteria();
        $criteria->compare('id', $this->id);
        $criteria->compare('username', $this->username, true);
        $criteria->compare('id_towns_user', $this->id_towns_user);
        $criteria->compare('role', $this->role);

        if (Yii::app()->user->role == self::ROLE_LOCALE_ADMIN) {
            $criteria->compare('id_towns_user', Yii::app()->user->getTownId(), true);
        }

        return new CActiveDataProvider($this, array(
                    'criteria' => $criteria,
                ));
    }

    public static function getActiveSet() {
        return array(self::USER_ACTIVE => "Активен", self::USER_INACTIVE => "Не активен");
    }

    public static function getRoles() {
        return array(
            self::ROLE_USER => 'Пользователь',
            self::ROLE_ORG => 'Организация',
            self::ROLE_LOCALE_ADMIN => 'Локальный администратор',
            self::ROLE_ADMIN => 'Администратор'
        );
    }

    public function authenticate($isMd5 = false) {
        $ident = new UserIdentity($this->email, $this->password);
        $duration = $this->rememberMe ? 3600 * 24 * 30 : 0;

        if ($ident->authenticate($isMd5)) {
            Yii::app()->user->login($ident, $duration);
            return true;
        }

        $this->addError('password', 'Неправильное имя пользователя или пароль.');
    }

    public function uauthenticate() {
        $ident = new UloginUserIdentity();
        $duration = $this->rememberMe ? 3600 * 24 * 30 : 0;

        if ($ident->authenticate($this)) {
            Yii::app()->user->login($ident, $duration);
            return true;
        }
        return false;
    }

    public function beforeSave() {
        if (parent::beforeSave()) {
            if ($this->isNewRecord) {
                $this->createtime = time();
            }
            // in this case, we will use the old hashed password.
            if (empty($this->password) && empty($this->password2) && !empty($this->initialPassword)) {
                $this->password = $this->password2 = $this->initialPassword;
            }

            $this->address = json_encode($this->addressList);
            return true;
        }
    }

    public function beforeValidate() {
        if (parent::beforeValidate()) {
            $this->address = json_encode($this->addressList);
            return true;
        }
    }

    public function afterFind() {
        //reset the password to null because we don't want the hash to be shown.
        $this->initialPassword = $this->password;

        parent::afterFind();
    }

    public function saveModel($data = array()) {
        //because the hashes needs to match
        if (!empty($data['password']) && !empty($data['password2'])) {
            $data['password'] = User::hashPassword($data['password']);
            $data['password2'] = User::hashPassword($data['password2']);
        }

        $this->attributes = $data;
        //CVarDumper::dump($data,10,true);die();
        if (!$this->save())
            return CHtml::errorSummary($this);

        return true;
    }

    /**
     * сохранение прикрепленного изображения к акции
     * TODO: выполнить рефакторинг с вынесением в отдельный класс
     * выводим тот порядок, в котором находится пользователь
     * необходимо для того, чтобы понимать в какой папке хранится аватар
     * @return int 
     */
    private function getCurrentOrder() {
        $current_order = 1000;
        while ($this->id > $current_order)
            $current_order += 1000;

        return $current_order;
    }

    /**
     * функция возвращает путь до оригинального файла аватара или с измененным
     * размером
     * @param int идентификатор пользователя
     * @param md5_hash мд5 хеш оригинального файла
     * @param type original|resized
     * @return string путь до файла
     * @throws Exception исключение, которое возникает если тип аватара задан неверно
     */
    public function getAvatarSavePath($md5_hash, $type) {
        if (!in_array($type, array("original", "resized")))
            throw new Exception("Unknown avatar type");
        else {
            if (!is_dir($_SERVER["DOCUMENT_ROOT"] . "/upload/avatar/" . $type . "/" . $this->getCurrentOrder()))
                mkdir($_SERVER["DOCUMENT_ROOT"] . "/upload/avatar/" . $type . "/" . $this->getCurrentOrder(), 0777, true);

            return $_SERVER["DOCUMENT_ROOT"] . "/upload/avatar/" . $type . "/" . $this->getCurrentOrder() . "/" . $md5_hash . ".jpg";
        }
    }

    /**
     * возвращаем по типу (resized,original) web путь к аватару
     * @param resized|original
     * @return string web путь до картинки относительно корня сайта 
     */
    public function getAvatarWebPath($type) {
        return "/upload/avatar/" . $type . "/" . $this->getCurrentOrder() . "/" . $this->avatar . ".jpg";
    }

//TODO: перенести в хелпер
    public function getAvatarImageHtmlCode($type) {
        if ($this->avatar)
            return "<img src='" . $this->getAvatarWebPath($type) . "' >";
        else
            return "";
    }

    /**
     * сохраняем аватар пользователя 
     */
    public function saveAvatar() {
        $this->avatar = CUploadedFile::getInstance($this, 'avatar');
        if (!empty($this->avatar->tempName)) {
            $orig_save_path = $this->getAvatarSavePath(md5_file($this->avatar->tempName), "original");
            $this->avatar->saveAs($orig_save_path);
            $resize_save_path = $this->getAvatarSavePath(md5_file($orig_save_path), "resized");
            WideImage::load($orig_save_path)->resize(100, 100)->saveToFile($resize_save_path);
            $this->avatar = md5_file($orig_save_path);
            $this->save(false);
        }
    }

    /**
     * удаляем аватар пользователя
     * @return boolean 
     */
    public function deleteAvatar() {
        $avatar = $this->avatar;
        if (!empty($this->avatar))
            if (unlink($this->getAvatarSavePath($this->avatar, "original"))
                    &&
                    unlink($this->getAvatarSavePath($this->avatar, "resized"))) {
                $this->avatar = NULL;
                $this->save();
                User::model()->updateAll(array("avatar" => NULL), "avatar='" . $avatar . "'");
                return true;
            }
        return false;
    }

    /**
     * перед удаление элемента удаляем аватар
     * @return boolean
     */
    public function beforeDelete() {
        $this->deleteAvatar();
        return parent::beforeDelete();
    }

    public function getAvatarSrc($type) {
        if ($this->avatar)
            return $this->getAvatarSavePath($this->avatar, $type);
        else
            return false;
    }

    /**
     * Добавить или удалить пользователя из рассылки
     * @param bool $subscribe
     */
    public function setSubscribe($subscribe) {
        if ($subscribe !== $this->subscribe) {
            $this->subscribe = $subscribe;
            $newsLetter = Newsletter::model()->findByPk($this->id);
            if ($subscribe && null === $newsLetter) {
                $newsLetter = new Newsletter();
                $newsLetter->email_user = $this->email;
                $newsLetter->id_user = $this->id;
                $newsLetter->save();
            }
            if (!$subscribe) {
                Newsletter::model()->deleteByPk($this->id);
            }
        }
    }

    /**
     * Если пользователь подписан на рассыку, вернет true иначе false
     * @return bool
     */
    public function getSubscribe() {
        if (null === $this->subscribe) {
            $subscribe = Newsletter::model()->findByPk($this->id);

            if (null === $subscribe) {
                $this->subscribe = false;
            } else {
                $this->subscribe = true;
            }
        }
        return $this->subscribe;
    }

    public function raiseBonus() {
        $this->bonus = $this->bonus + Act::model()->getRaiseBonusCount();
        $this->save();
    }

    public function getAddressListArray() {
        if ($this->addressList) {
            return $this->addressList;
        }

        return !$this->address ? array() : json_decode($this->address, true);
    }

    public function getAddressToStr($separator) {
        $array = json_decode($this->address);
        $str = '';

        foreach ($array as $address) {
            $str .= $address->address . $separator;
        }

        return $str;
    }

    public function getAddressToArray() {
        return json_decode($this->address);
    }

    public function getOrgListData() {
        return CHtml::listData(User::model()->findAll(array(
                            'condition' => 'role = :role',
                            'params' => array(
                                ':role' => 'organisation',
                            ),
                        )), 'id', 'company_name');
    }

}