<?php


namespace Appino\Blockchain\Objects;


class Outpoint{

    public $tx_index;
    public $n;

    public function __construct($params){
        $this->tx_index = data_get($params,'tx_index');
        $this->n = data_get($params,'n');
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
