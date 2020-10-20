<?php


namespace Appino\Blockchain\Objects;


use Psy\Util\Json;

class NotificationResponse{
    public $id;
    public $address;
    public $height;
    public $callback;
    public $confs;
    public $op;
    public $onNotification;

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
        return Json::encode($response);
    }

}
