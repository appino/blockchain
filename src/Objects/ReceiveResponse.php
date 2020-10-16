<?php


namespace Appino\Blockchain\Objects;


class ReceiveResponse{
    /**
     * @var string
     */
    public $address;
    /**
     * @var integer
     */
    public $index;
    /**
     * @var string
     */
    public $callback;

    public function __construct($json){
        if(array_key_exists('address',$json))
            $this->address = data_get($json,'address');
        if(array_key_exists('index',$json))
            $this->index = data_get($json,'index');
        if(array_key_exists('callback',$json))
            $this->callback = data_get($json,'callback');
    }

}
