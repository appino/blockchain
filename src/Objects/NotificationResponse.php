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

    public function __construct($json){
        foreach ($json as $key => $value){
            $this->{$key} = $value;
        }
    }

}
