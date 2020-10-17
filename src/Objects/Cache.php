<?php


namespace Appino\Blockchain\Objects;


class Cache{

    public $receiveAccount;
    public $changeAccount;

    public function __construct($params){
        if(array_key_exists('receiveAccount',$params))
            $this->receiveAccount = data_get($params,'receiveAccount');
        if(array_key_exists('changeAccount',$params))
            $this->changeAccount = new Cache(data_get($params,'changeAccount'));
    }

}
