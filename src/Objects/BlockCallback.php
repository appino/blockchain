<?php


namespace Appino\Blockchain\Objects;


use Psy\Util\Json;

class BlockCallback{

    public $hash;
    public $confirmations;
    public $height;
    public $timestamp;
    public $size;

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
