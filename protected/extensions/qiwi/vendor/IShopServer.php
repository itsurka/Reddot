<?php

class IShopServer {

    public function updateBill($param) {
        $qiwi = new Qiwi();

        $responce = new IShopResponse();
        $responce->updateBillResult = $qiwi->update($param);
        return $responce;
    }

}