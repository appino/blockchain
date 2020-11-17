<?php


namespace Appino\Blockchain\Objects;


class Block{

    public $hash;
    public $ver;
    public $prev_block;
    public $mrkl_root;
    public $time;
    public $bits;
    public $nonce;
    public $n_tx;
    public $size;
    public $block_index;
    public $main_chain;
    public $height;
    public $received_time;
    public $relayed_by;
    public $transactions = array();

    public function __construct($params){
        $this->hash = data_get($params, 'hash');
        $this->ver = data_get($params, 'ver');
        $this->prev_block = data_get($params, 'prev_block');
        $this->mrkl_root = data_get($params, 'mrkl_root');
        $this->time = data_get($params, 'time');
        $this->bits = data_get($params, 'bits');
        $this->nonce = data_get($params, 'nonce');
        $this->n_tx = data_get($params, 'n_tx');
        $this->size = data_get($params, 'size');
        $this->block_index = data_get($params, 'block_index');
        $this->main_chain = data_get($params, 'main_chain');
        $this->height = data_get($params, 'height');
        $this->received_time = data_get($params, 'received_time');
        $this->relayed_by = data_get($params, 'relayed_by');
        foreach (data_get($params,'tx',[]) as $value){
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
