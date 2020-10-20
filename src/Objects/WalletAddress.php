<?php

namespace Appino\Blockchain\Objects;

use Appino\Blockchain\Objects\Cache;
use Psy\Util\Json;

class WalletAddress{
    /**
     * @var string
     */
    public $label;
    /**
     * @var string
     */
    public $archived;
    /**
     * @var string
     */
    public $xpriv;
    /**
     * @var string
     */
    public $xpub;
    /**
     * @var array
     */
    public $addresslabels;
    /**
     * @var Cache
     */
    public $cahce;

    /**
     * AccountResponse constructor.
     * @param $params array|object
     */

    public function __construct($params){
        //echo Json::encode($params);
        if(is_null($params))
            return;
        $this->label = data_get($params,'label');
        $this->archived = data_get($params,'archived');
        $this->xpriv = data_get($params,'xpriv');
        $this->xpub = data_get($params,'xpub');
        $this->addresslabels = data_get($params,'addresslabels',array());
        $this->cahce = new Cache(data_get($params,'cache'));
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
