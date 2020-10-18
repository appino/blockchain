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
        $this->guid = data_get($params,'balance');
        $this->address = data_get($params,'address');
        $this->label = data_get($params,'label');
    }

}
