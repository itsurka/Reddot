<?php

class UloginUserIdentity implements IUserIdentity
{
    private $id;
    private $name;
    public  $errors;
    private $isAuthenticated = false;
    private $states = array();

    public function __construct()
    {
    }

    public function authenticate( User $userObj = null)
    {
        $criteria = new CDbCriteria;
        $criteria->condition = 'soc_uid=? AND soc_network=?';
        $criteria->params = array( $userObj->soc_uid, $userObj->soc_network );
        $user = User::model()->find($criteria);

        if ( null === $user ) {
            if ( ! $userObj->save(false) ) {
                return false;
            };
        } else {
            $userObj = $user;
        }
        $this->id   = $userObj->id;
        $this->name = $userObj->first_name;
        $this->isAuthenticated = true;
        return true;
    }

    public function getId()
    {
        return $this->id;
    }

    public function getIsAuthenticated()
    {
        return $this->isAuthenticated;
    }

    public function getName()
    {
        return $this->name;
    }

    public function getPersistentStates()
    {
        return $this->states;
    }
}