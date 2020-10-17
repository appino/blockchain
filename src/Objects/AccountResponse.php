<?php

namespace Appino\Blockchain\Objects;

use Appino\Blockchain\Objects\Cache;

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
     * @var string
     */
    public $address_labels;
    /**
     * @var Cache
     */
    public $cahce;

    /**
     * AccountResponse constructor.
     * @param $json array|object
     */

    public function __construct($json){
        if(array_key_exists('balance',$json))
            $this->balance = data_get($json,'balance');
        if(array_key_exists('address',$json))
            $this->label = data_get($json,'address');
        if(array_key_exists('label',$json))
            $this->index = data_get($json,'label');
        if(array_key_exists('archived',$json))
            $this->archived = data_get($json,'archived');
        if(array_key_exists('extendedPublicKey',$json))
            $this->extendedPublicKey = data_get($json,'extendedPublicKey');
        if(array_key_exists('extendedPrivateKey',$json))
            $this->extendedPrivateKey = data_get($json,'extendedPrivateKey');
        if(array_key_exists('receiveIndex',$json))
            $this->receiveIndex = data_get($json,'receiveIndex');
        if(array_key_exists('lastUsedReceiveIndex',$json))
            $this->lastUsedReceiveIndex = data_get($json,'lastUsedReceiveIndex');
        if(array_key_exists('receiveAddress',$json))
            $this->receiveAddress = data_get($json,'receiveAddress');
        if(array_key_exists('cache',$json))
            $this->cahce = new Cache(data_get($json,'cache'));
    }

}
