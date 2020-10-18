<?php


namespace Appino\Blockchain\Objects;


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

}
