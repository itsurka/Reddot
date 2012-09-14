<?php

class Qiwi extends CApplicationComponent {

    public $login = '';
    public $password = '';

    public function init() {
        if (!extension_loaded('soap')) {
            throw new Exception('SOAP::You must have SOAP enabled in order to use this extension.');
        }
    }

    public function update($params) {
        if (!$this->checkPassword($params->password))
            throw new Exception('Bad password');

        if ($params->status == 60) {
            $operation = Operation::model()->findByPk($params->txn);
            if ($operation) {
                $operation->setStatus(Operation::STATUS_SUCCESS);
            }
        }

        return 0;
    }

    protected function checkPassword($password) {
        return true;
    }

    public function updateBill() {
        $this->setSoapServer();
    }

    protected function setSoapServer() {
        Yii::import('ext.qiwi.vendor.*');
        $vendor = Yii::getPathOfAlias('ext.qiwi.vendor') . DIRECTORY_SEPARATOR;
        $iShopServerWSPath = $vendor . 'IShopClientWS.wsdl';

        $server = new SoapServer($iShopServerWSPath, array(
            'classmap' => array(
                'tns:updateBill' => 'IShopParams',
                'tns:updateBillResponse' => 'IShopResponse',
        )));

        $server->setClass('IShopServer');
        $server->handle();
    }

}