<?php


namespace Appino\Blockchain\Objects;


class MultiAddress{

    public $addresses = array();
    public $wallet;
    public $transactions = array();

    public function __construct($params){
        foreach (data_get($params, 'addresses') as $address)
            $this->addresses[] = new Address($address);
        $this->wallet = new Wallet(data_get($params, 'wallet'));
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
