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
     * @param $json array
     */

    public function __construct($json){
        if(array_key_exists('to',$json))
            $this->to = data_get($json,'to');
        if(array_key_exists('from',$json))
            $this->from = data_get($json,'from');
        if(array_key_exists('amount',$json))
            $this->amount = data_get($json,'amount');
        if(array_key_exists('fee',$json))
            $this->fee = data_get($json,'fee');
        if(array_key_exists('txid',$json))
            $this->txid = data_get($json,'txid');
        if(array_key_exists('succevss',$json))
            $this->succevss = data_get($json,'success');
    }

}
