<?php

$s = new SoapServer('IShopClientWS.wsdl', array(
    'classmap' => array(
        'tns:updateBill' => 'Param',
        'tns:updateBillResponse' => 'Response',
)));

$s->setClass('TestServer');
$s->handle();

class Response {

    public $updateBillResult;

}

class Param {

    public $login;
    public $password;
    public $txn;
    public $status;

}

class TestServer {

    function updateBill($param) {

        $f = fopen('phpdump.txt', 'w');
        fwrite($f, $param->login);
        fwrite($f, ', ');
        fwrite($f, $param->password);
        fwrite($f, ', ');
        fwrite($f, $param->txn);
        fwrite($f, ', ');
        fwrite($f, $param->status);
        fclose($f);

        if ($param->status == 60) {
            
        } else if ($param->status > 100) {
            
        } else if ($param->status >= 50 && $param->status < 60) {
            
        } else {
            
        }

        $temp = new Response();
        $temp->updateBillResult = 0;
        return $temp;
    }

}