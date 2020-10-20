<?php


namespace Appino\Blockchain\Objects;


use Psy\Util\Json;

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

    public function __toString(){
        $class_vars = get_class_vars(get_class($this));
        $response = [];
        foreach ($class_vars as $key => $value){
            $response[$key] = $this->{$key};
        }
        return json_encode($response, JSON_THROW_ON_ERROR) ."";
    }

}
