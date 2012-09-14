<?php

class UserMenuWidget extends CWidget {

    public $towns = array();
    public $loginForm = null;
    public $registerForm = null;

    public function init() {
        $this->towns = Town::model()->findAll();
        $this->loginForm = new User('login');
        $this->registerForm = new User('register');
    }

    public function run() {
        $this->render('userMenuWidget');
    }

}