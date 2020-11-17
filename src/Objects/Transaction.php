<?php


namespace Appino\Blockchain\Objects;


class Transaction{

    public $hash;
    public $ver;
    public $vin_sz;
    public $vout_sz;
    public $lock_time;
    public $size;
    public $relayed_by;
    public $block_height;
    public $tx_index;
    public $inputs;
    public $outputs;
    public $rbf;

    public function __construct($params){
        $this->hash = data_get($params, 'hash');
        $this->ver = data_get($params, 'ver');
        $this->vin_sz = data_get($params, 'vin_sz');
        $this->vout_sz = data_get($params, 'vout_sz');
        $this->lock_time = data_get($params, 'lock_time');
        $this->size = data_get($params, 'size');
        $this->relayed_by = data_get($params, 'relayed_by');
        $this->block_height = data_get($params, 'block_height');
        $this->tx_index = data_get($params, 'tx_index');
        $this->rbf = data_get($params, 'tx_index');
        foreach (data_get($params, 'inputs',[]) as $value)
            $this->inputs[] = new Input($value);
        foreach (data_get($params, 'outputs',[]) as $value)
            $this->outputs[] = new Output($value);
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
