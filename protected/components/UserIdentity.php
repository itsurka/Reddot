<?php

/**
 * UserIdentity represents the data needed to identity a user.
 * It contains the authentication method that checks if the provided
 * data can identity the user.
 */
class UserIdentity extends CUserIdentity {

    private $_id;

    /**
     * Authenticates a user.
     * @return boolean whether authentication succeeds.
     */
    /*
      public function authenticate()
      {
      $user=User::model()->find('LOWER(username)=?',array(strtolower($this->username)));
      if($user===null)
      $this->errorCode=self::ERROR_USERNAME_INVALID;
      else if($user->password!==$this->password)
      $this->errorCode=self::ERROR_PASSWORD_INVALID;
      else
      {
      $user->lastvisit = time();
      $user->save(false);
      $this->_id=$user->id;
      $this->username=$user->username;
      $this->errorCode=self::ERROR_NONE;
      }
      return $this->errorCode==self::ERROR_NONE;
      }
     */
    public function authenticate($idMd5 = false) {
        $model = User::model()->findByAttributes(array('email' => $this->username));
        if (is_object($model)) {
            if ($idMd5 === false) {
                $password = $model->hashPassword($this->password);
            }
            else {
                $password = $this->password;
            }

            if ($model->password === $password) {
                $this->_id = $model->id;
                $this->setState('username', $model->username);

                $this->errorCode = self::ERROR_NONE;
            }
            else {
                $this->errorCode = self::ERROR_PASSWORD_INVALID;
            }
        }
        else {
            $this->errorCode = self::ERROR_USERNAME_INVALID;
        }

        return !$this->errorCode;
    }

    /**
     * @return integer the ID of the user record
     */
    public function getId() {
        return $this->_id;
    }

}