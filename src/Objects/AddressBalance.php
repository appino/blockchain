<?php


namespace Appino\Blockchain\Objects;


class AddressBalance{

    public $address;
    public $final_balance;
    public $n_tx;
    public $total_received;

    public function __construct($address, $params){
        $this->address = $address;
        $this->final_balance = data_get($params, 'final_balance');
        $this->n_tx = data_get($params, 'n_tx');
        $this->total_received = data_get($params, 'total_received');
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
