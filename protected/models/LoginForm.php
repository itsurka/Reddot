<?php

/**
 * LoginForm class.
 * LoginForm is the data structure for keeping
 * user login form data. It is used by the 'login' action of 'SiteController'.
 */
class LoginForm extends CActiveRecord
{
	public $username;
	public $password;
	public $rememberMe;
	public $verifyCode;

	private $_identity;

	public static function model($className=__CLASS__)
     {
         return parent::model($className);
     }

	public function tableName()
     {
         return 'users';
     }

	/**
	 * Declares the validation rules.
	 * The rules state that username and password are required,
	 * and password needs to be authenticated.
	 */
	  public function rules()
    {
         return array(
            // логин, пароль не должны быть больше 128-и символов, и меньше трёх
            array('username, password', 'length', 'max'=>128, 'min' => 3),
            // логин, пароль не должны быть пустыми
             array('username, password', 'required'),
             // правило для проверки капчи что капча совпадает с тем что ввел пользователь
            array('verifyCode', 'captcha', 'allowEmpty'=>!extension_loaded('gd')),
            // проверка пароля нашим методом authenticate
             array('password', 'authenticate', 'on' => 'login'),
           array('username', 'match', 'pattern' => '/^[A-Za-z0-9А-Яа-я\s,]+$/u','message' => 'Логин содержит недопустимые символы.'),
       );
    }

	/**
	 * Declares attribute labels.
	 */
	public function attributeLabels()
	{
		return array(
			'rememberMe'=>'Запомнить меня',
            'username'  => 'Логин',
            'password'  => 'Пароль',
            'password2' => 'Повтори пароль',
		);
	}

	public function safeAttributes()
     {
         return array('username', 'password', 'password2', 'rememberMe', 'verifyCode');
     }

	/**
	 * Authenticates the password.
	 * This is the 'authenticate' validator as declared in rules().
	 */
	public function authenticate($attribute,$params) 
    {
        // Проверяем были ли ошибки в других правилах валидации.
        // если были - нет смысла выполнять проверку
         if(!$this->hasErrors())
        {
            // Создаем экземпляр класса UserIdentity
            // и передаем в его конструктор введенный пользователем логин и пароль (с формы)
            $identity= new UserIdentity($this->username, md5($this->password));
             // Выполняем метод authenticate (о котором мы с вами говорили пару абзацев назад)
            // Он у нас проверяет существует ли такой пользователь и возвращает ошибку (если она есть)
            // в $identity->errorCode
             $identity->authenticate();
                
                // Теперь мы проверяем есть ли ошибка..    
                switch($identity->errorCode)
                {
                    // Если ошибки нету...
                     case UserIdentity::ERROR_NONE: {
                        $duration=$this->rememberMe ? 3600*24*30 : 0; // 30 days
                        Yii::app()->user->login($identity,$duration);

                        $cookie = new CHttpCookie('town', User::getTownId());
                        $cookie->expire = time()+60*60*24*365*10; 
                        Yii::app()->request->cookies['town'] = $cookie;

                        //Yii::app()->user->login($identity, 0);
                        break;
                    }
                    case UserIdentity::ERROR_USERNAME_INVALID: {
                         // Если логин был указан наверно - создаем ошибку
                        $this->addError('usermane','Пользователь не существует!');
                        break;
                    }
                     case UserIdentity::ERROR_PASSWORD_INVALID: {
                        // Если пароль был указан наверно - создаем ошибку
                        $this->addError('password','Вы указали неверный пароль!');
                         break;
                    }
                }
        }
    }



}