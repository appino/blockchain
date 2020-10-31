<?php


namespace Appino\Blockchain\Objects;


class Rate{

    public $currency;
    public $m15;
    public $last;
    public $buy;
    public $sell;

    public function __construct($currency, $params){
        if(is_null($params))
            return;
        $this->currency = $currency;
        $this->m15 = data_get($params,'15m');
        $this->last = data_get($params,'last');
        $this->buy = data_get($params,'buy');
        $this->sell = data_get($params,'sell');
        $this->symbol = data_get($params,'symbol');
    }

}
