<?php


namespace Appino\Blockchain\Objects;


class LatestBlock{

    public $hash;
    public $time;
    public $block_index;
    public $height;
    public $txIndexes;

    public function __construct($params){
        $this->hash = data_get($params, 'hash');
        $this->time = data_get($params, 'time');
        $this->block_index = data_get($params, 'block_index');
        $this->height = data_get($params, 'height');
        $this->txIndexes = data_get($params, 'txIndexes');
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
