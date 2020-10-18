<?php


namespace Appino\Blockchain\Objects;


class BalanceCallback{

    public $transaction_hash;
    public $address;
    public $confirmation;
    public $value;

    /**
     * BalanceCallback constructor. You can call your custom parameters.
     * @param $params
     */

    public function __construct($params){
        if(is_null($params))
            return;
        foreach ($params as $key => $value){
            $this->{$key} = $value;
        }
    }

}
