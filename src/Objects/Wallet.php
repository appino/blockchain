<?php


namespace Appino\Blockchain\Objects;


class Wallet{

    public $final_balance;
    public $n_tx;
    public $n_tx_filtered;
    public $total_received;
    public $total_sent;

    public function __construct($params){
        $this->final_balance = data_get($params, 'final_balance');
        $this->n_tx = data_get($params, 'n_tx');
        $this->n_tx_filtered = data_get($params, 'n_tx_filtered');
        $this->total_received = data_get($params, 'total_received');
        $this->total_sent = data_get($params, 'total_sent');
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
