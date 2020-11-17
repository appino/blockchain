<?php


namespace Appino\Blockchain\Objects;


class Address{

    public $hash160;
    public $address;
    public $n_tx;
    public $n_unredeemed;
    public $total_received;
    public $total_sent;
    public $final_balance;
    public $transactions;

    public function __construct($params){
        $this->hash160 = data_get($params, 'hash160');
        $this->address = data_get($params, 'address');
        $this->n_tx = data_get($params, 'n_tx');
        $this->n_unredeemed = data_get($params, 'n_unredeemed');
        $this->total_received = data_get($params, 'total_received');
        $this->total_sent = data_get($params, 'total_sent');
        $this->final_balance = data_get($params, 'final_balance');
        foreach (data_get($params,'txs',[]) as $value){
            $this->transactions[] = new Transaction($value);
        }
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
