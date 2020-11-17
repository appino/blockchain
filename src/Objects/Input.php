<?php


namespace Appino\Blockchain\Objects;


class Input{

    public $sequence;
    public $witness;
    public $prevout;
    public $script;

    public function __construct($params){
        $this->sequence = data_get($params,'sequence');
        $this->witness = data_get($params,'witness');
        $this->prevout = new Prevout(data_get($params,'prevout',[]));
        $this->script = data_get($params,'script');
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
