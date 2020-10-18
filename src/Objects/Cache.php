<?php


namespace Appino\Blockchain\Objects;


class Cache{

    public $receiveAccount;
    public $changeAccount;

    public function __construct($params){
        if(is_null($params))
            return;
        $this->receiveAccount = data_get($params,'receiveAccount');
        $this->changeAccount = new Cache(data_get($params,'changeAccount'));
    }

}
