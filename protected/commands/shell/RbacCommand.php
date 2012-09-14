<?php
/**
 * Создаем основные роли и операции 
 * @author Вольдэмар
 */
class RbacCommand  extends CConsoleCommand 
{
    private $_authManager;
    
    public function getHelp()
    {
        return "USAGE\n
        rbac\n
        DESCRIPTION\n
        This command generates an initial RBAC authorization hierarchy.";
    }
    
    public function run($args)
    {
        //ensure that an authManager is defined as this is mandatory
        //for creating an auth heirarchy
        if(($this->_authManager=Yii::app()->authManager)===null)
        {
            echo "Error: an authorization manager, named 'authManager'
            must be configured to use this command.\n";
            echo "If you already added 'authManager' component in
            application configuration,\n";
            echo "please quit and re-enter the yiic shell.\n";
        return;
        }
        //provide the oportunity for the use to abort the request
        echo "This command will create three roles: Admin, Organisation and
        Reader and the following premissions:\n";
        echo "create, read, update and delete user\n";
        echo "create, read, update and delete act\n";
        echo "Would you like to continue? [Yes|No] ";
        
        if(!strncasecmp(trim(fgets(STDIN)),'y',1))
        {
            $this->_authManager->clearAll();
            //create the lowest level operations for users
            $this->_authManager->createOperation("createUser","create
            a new user");
            $this->_authManager->createOperation("readUser","read
            user profile information");
            $this->_authManager->createOperation("updateUser","update
            a users information");
            $this->_authManager->createOperation("deleteUser","remove
            a user from a project");
            //create the lowest level operations for projects
            $this->_authManager->createOperation("createAct","cre
            ate a new act");
            $this->_authManager->createOperation("readAct","read
            act information");
            $this->_authManager->createOperation("updateAct","up
            date act information");
            $this->_authManager->createOperation("deleteAct","del
            ete a act");

            $role=$this->_authManager->createRole("reader");
            $role->addChild("readUser");
            $role->addChild("readAct");

            $role=$this->_authManager->createRole("organisation");
            $role->addChild("reader");
            $role->addChild("createAct");
            $role->addChild("updateAct");
            $role->addChild("deleteAct");

            //create the owner role, and add the appropriate permissions, as well
            //as both the reader and member roles as children
            $role=$this->_authManager->createRole("admin");
            $role->addChild("reader");
            $role->addChild("organisation");
            $role->addChild("createUser");
            $role->addChild("updateUser");
            $role->addChild("deleteUser");
            $role->addChild("createAct");
            $role->addChild("updateAct");
            $role->addChild("deleteAct");
            //provide a message indicating success
            echo "Authorization hierarchy successfully generated.";
        }
    }
}

?>
