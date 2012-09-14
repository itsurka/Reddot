<?php

define('LOGIN', 201501);
define('PASSWORD', 'e5hvyyux');


define('TRACE', 1);

include("IShopServerWSService.php");

$service = new IShopServerWSService('IShopServerWS.wsdl', array(
    'location' => 'http://ishop.qiwi.ru/services/ishop',
    'trace' => TRACE
));

function cancelBill($txn_id) {
    global $service;


    $params = new cancelBill();
    $params->login = LOGIN;
    $params->password = PASSWORD;
    $params->txn = $txn_id;
    $res = $service->cancelBill($params);
    print($res->cancelBillResult);
}

function createBill($phone, $amount, $txn_id, $comment, $lifetime = '', $alarm = 0, $create = true) {
    global $service;

    $params = new createBill();
    $params->login = LOGIN;
    $params->password = PASSWORD;
    $params->user = $phone;
    $params->amount = '' . $amount;
    $params->comment = $comment;
    $params->txn = $txn_id;
    $params->lifetime = $lifetime;
    $params->alarm = $alarm;

    $params->create = $create;

    $res = $service->createBill($params);

    $rc = $res->createBillResult;
    return $rc;
}

$rc = createBill('9102233388', '0.01', '12345', 'Test bill');
print($rc);