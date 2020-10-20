<?php

namespace Appino\Blockchain\Objects;


class AccountResponse{
    /**
     * @var string
     */
    public $balance;
    /**
     * @var string
     */
    public $label;
    /**
     * @var string
     */
    public $index;
    /**
     * @var string
     */
    public $archived;
    /**
     * @var string
     */
    public $extendedPublicKey;
    /**
     * @var string
     */
    public $extendedPrivateKey;
    /**
     * @var string
     */
    public $receiveIndex;
    /**
     * @var string
     */
    public $lastUsedReceiveIndex;
    /**
     * @var string
     */
    public $receiveAddress;

    /**
     * AccountResponse constructor.
     * @param $params array|object
     */

    public function __construct($params){
        if(is_null($params))
            return;
        $this->balance = data_get($params,'balance');
        $this->label = data_get($params,'label');
        $this->index = data_get($params,'index');
        $this->archived = data_get($params,'archived');
        $this->extendedPublicKey = data_get($params,'extendedPublicKey');
        $this->extendedPrivateKey = data_get($params,'extendedPrivateKey');
        $this->receiveIndex = data_get($params,'receiveIndex');
        $this->lastUsedReceiveIndex = data_get($params,'lastUsedReceiveIndex');
        $this->receiveAddress = data_get($params,'receiveAddress');
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
