<?php

class WebUser extends CWebUser {

    private $_model = null;
    private $_town = null;
    private $_balance = null;
    private $_bonus = null;

    function getRole() {
        if (($user = $this->getModel())) {
            // в таблице User есть поле role
            return $user->role;
        }
    }

    public function getBonus() {
        if ($this->_bonus === null) {
            if ($this->isGuest) {
                $this->_bonus = 0;
            }
            else {
                $this->_bonus = $this->model->bonus;
            }
        }

        return $this->_bonus;
    }

    public function getBalance() {
        if ($this->_balance === null) {
            if ($this->isGuest) {
                $this->_balance = 0;
            }
            else {
                $this->_balance = $this->model->balance;
            }
        }

        return $this->_balance;
    }

    function getTownId() {
        if ($user = $this->getModel()) {
            return $this->_model->id_towns_user;
        }
    }

    public function getTown() {
        if ($this->_town == null) {
            if ($this->getState('town')) {
                $this->_town = Town::model()->findByPk((int) $this->getState('town'));
            }
            elseif (isset($this->model->id_towns_user)) {
                $this->_town = Town::model()->findByPk($this->model->id_towns_user);
            }
            else {
                $defaultId = 2; // Нужно откудо-то получить ID города, который будет использовать по умолчанию
                $this->_town = Town::model()->findByPk($defaultId);
            }
        }

        return $this->_town;
    }

    public function getModel() {
        if (!$this->isGuest && $this->_model === null) {
            $this->_model = User::model()->findByPk($this->id, array(
                'select' => 'role, email, id_towns_user, username, first_name, last_name, balance, bonus',
            ));
        }

        return $this->_model;
    }

    public function getDisplayName() {
        if (!isset($this->model->first_name)) {
            return null;
        }

        if (strlen($this->model->first_name . ' ' . $this->model->last_name) > 3)
            $displayName = $this->model->first_name . ' ' . $this->model->last_name;
        elseif (strlen($this->model->username) > 3)
            $displayName = $this->model->username;
        else
            $displayName = $this->model->email;

        return $displayName;
    }

    public function getEmail() {
        return $this->getModel() ? $this->getModel()->email : null;
    }

}