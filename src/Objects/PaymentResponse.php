<?php


namespace Appino\Blockchain\Objects;


class PaymentResponse{
    /**
     * @var array of string
     */
    public $to;
    /**
     * @var array of string
     */
    public $from;
    /**
     * @var array of integer in satoshi
     */
    public $amount;
    /**
     * @var integer in satoshi
     */
    public $fee;
    /**
     * @var string
     */
    public $txid;
    /**
     * @var bool
     */
    public $success;

    /**
     * PaymentResponse constructor.
     * @param $params array
     */

    public function __construct($params){
        if(is_null($params))
            return;
        $this->to = data_get($params,'to');
        $this->from = data_get($params,'from');
        $this->amount = data_get($params,'amount');
        $this->fee = data_get($params,'fee');
        $this->txid = data_get($params,'txid');
        $this->success = data_get($params,'success');
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
