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
     * @param $params array|object
     */

    public function __construct($params){
        if(is_null($params))
            return;
        $this->balance = data_get($params,'balance');
        $this->label = data_get($params,'address');
        $this->index = data_get($params,'label');
        $this->archived = data_get($params,'archived');
        $this->extendedPublicKey = data_get($params,'extendedPublicKey');
        $this->extendedPrivateKey = data_get($params,'extendedPrivateKey');
        $this->receiveIndex = data_get($params,'receiveIndex');
        $this->lastUsedReceiveIndex = data_get($params,'lastUsedReceiveIndex');
        $this->receiveAddress = data_get($params,'receiveAddress');
        $this->cahce = new Cache(data_get($params,'cache'));
    }

}
