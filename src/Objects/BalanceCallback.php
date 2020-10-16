<?php


namespace Appino\Blockchain\Objects;


class BalanceCallback{

    public $transaction_hash;
    public $address;
    public $confirmation;
    public $value;

    /**
     * BalanceCallback constructor. You can call your custom parameters.
     * @param $json
     */

    public function __construct($json){
        foreach ($json as $key => $value){
            $this->{$key} = $value;
        }
    }

}
