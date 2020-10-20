<?php


namespace Appino\Blockchain\Objects;


use Psy\Util\Json;

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

    public function __construct($params){
        if(is_null($params))
            return;
        $this->address = data_get($params,'address');
        $this->index = data_get($params,'index');
        $this->callback = data_get($params,'callback');
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
