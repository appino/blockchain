<?php


namespace Appino\Blockchain\Objects;


class Prevout{

    public $spent;
    public $spending_outpoints;
    public $tx_index;
    public $type;
    public $value;
    public $n;
    public $script;

    public function __construct($params){
        $this->spent = data_get($params,'spent',false);
        foreach (data_get($params,'spending_outpoints',[]) as $value)
            $this->spending_outpoints[] = new Outpoint($value);
        $this->tx_index = data_get($params,'tx_index');
        $this->type = data_get($params,'type');
        $this->value = data_get($params,'value');
        $this->n = data_get($params,'n');
        $this->script = data_get($params,'script');
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
