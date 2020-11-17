<?php


namespace Appino\Blockchain\Objects;


class UnspentOutput{

    public $tx_hash;
    public $tx_hash_big_endian;
    public $tx_output_n;
    public $script;
    public $value;
    public $value_hex;
    public $confirmations;
    public $tx_index;

    public function __construct($params){
        $this->tx_hash = data_get($params, 'tx_hash');
        $this->tx_hash_big_endian = data_get($params, 'tx_hash_big_endian');
        $this->tx_output_n = data_get($params, 'tx_output_n');
        $this->script = data_get($params, 'script');
        $this->value = data_get($params, 'value');
        $this->value_hex = data_get($params, 'value_hex');
        $this->confirmations = data_get($params, 'confirmations');
        $this->tx_index = data_get($params, 'tx_index');
    }

}
