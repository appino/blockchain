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
        $this->to = data_get($json,'to');
        $this->from = data_get($json,'from');
        $this->amount = data_get($json,'amount');
        $this->fee = data_get($json,'fee');
        $this->txid = data_get($json,'txid');
        $this->success = data_get($json,'success');
    }

}
