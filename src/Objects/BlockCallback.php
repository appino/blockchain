<?php


namespace Appino\Blockchain\Objects;


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


}
