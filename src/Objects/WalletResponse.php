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
     * @param $json array|object
     */

    public function __construct($json){
        if(array_key_exists('guid',$json))
            $this->guid = data_get($json,'balance');
        if(array_key_exists('address',$json))
            $this->address = data_get($json,'address');
        if(array_key_exists('label',$json))
            $this->label = data_get($json,'label');
    }

}
