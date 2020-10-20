<?php

namespace Appino\Blockchain\Objects;

class WalletResponse{

    /**
     * @var string
     */
    public $guid;
    /**
     * @var string
     */
    public $address;
    /**
     * @var string
     */
    public $label;

    /**
     * AccountResponse constructor.
     * @param $params array|object
     */

    public function __construct($params){
        if(is_null($params))
            return;
        $this->guid = data_get($params,'guid');
        $this->address = data_get($params,'address');
        $this->label = data_get($params,'label');
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
