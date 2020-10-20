<?php


namespace Appino\Blockchain\Objects;


use Psy\Util\Json;

class Cache{

    public $receiveAccount;
    public $changeAccount;

    public function __construct($params){
        if(is_null($params))
            return;
        $this->receiveAccount = data_get($params,'receiveAccount');
        $this->changeAccount = data_get($params,'changeAccount');
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
