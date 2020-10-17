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
        $this->balance = data_get($json,'balance');
        $this->label = data_get($json,'address');
        $this->index = data_get($json,'label');
        $this->archived = data_get($json,'archived');
        $this->extendedPublicKey = data_get($json,'extendedPublicKey');
        $this->extendedPrivateKey = data_get($json,'extendedPrivateKey');
        $this->receiveIndex = data_get($json,'receiveIndex');
        $this->lastUsedReceiveIndex = data_get($json,'lastUsedReceiveIndex');
        $this->receiveAddress = data_get($json,'receiveAddress');
        $this->cahce = new Cache(data_get($json,'cache'));
    }

}
