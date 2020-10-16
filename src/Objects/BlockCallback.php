<?php


namespace Appino\Blockchain\Objects;


class BlockCallback{

    public $hash;
    public $confirmations;
    public $height;
    public $timestamp;
    public $size;

    public function __construct($json){
        foreach ($json as $key => $value){
            $this->{$key} = $value;
        }
    }


}
