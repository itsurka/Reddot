<?php
 class RegisterForm extends CActiveRecord
 {        
     // для капчи
     public $verifyCode;
     // для поля "повтор пароля"
     public $passwd2;
     
     public static function model($className=__CLASS__)
     {
         return parent::model($className);
     }
     
     public function tableName()
     {
         return 'users';
     }
 
     /**
      * Правила валидации
      */
     public function rules()
     {
         return array(
             // логин, пароль не должны быть больше 128-и символов, и меньше трёх
             array('username, password', 'length', 'max'=>128, 'min' => 3),
             // логин, пароль не должны быть пустыми
             array('username, password', 'required'),
             // для сценария registration поле passwd должно совпадать с полем passwd2
             array('password', 'compare', 'compareAttribute'=>'password2', 'on'=>'registration'),
             // правило для проверки капчи что капча совпадает с тем что ввел пользователь
             array('verifyCode', 'captcha', 'allowEmpty'=>!extension_loaded('gd')),
             array('username', 'match', 'pattern' => '/^[A-Za-z0-9А-Яа-я\s,]+$/u','message' => 'Логин содержит недопустимые символы.'),
        );
     }
     
     /**
      * Список атрибутов которые могут быть массово присвоены
      * в любом из наших сценариев
      *
      * @return unknown
      */
     public function safeAttributes()
     {
         return array('username', 'password', 'password2', 'verifyCode');
     }



     
     /**
      * Список синонимов
      */
     public function attributeLabels()
     {
         return array(
             'username'  => 'Логин',
             'password'  => 'Пароль',
             'password2' => 'Повтори пароль',
         );
     }
 }