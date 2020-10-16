<?php


namespace Appino\Blockchain\Objects;


class LogResponse{

    /**
     * @var string
     */
    public $callback;
    /**
     * @var string
     */
    public $called_at;
    /**
     * @var string
     */
    public $raw_response;
    /**
     * @var int
     */
    public $response_code;

    public function __construct($json){
        if(array_key_exists('callback',$json))
            $this->callback = data_get($json,'callback');
        if(array_key_exists('called_at',$json))
            $this->called_at = data_get($json,'called_at');
        if(array_key_exists('raw_response',$json))
            $this->raw_response = data_get($json,'raw_response');
        if(array_key_exists('response_code',$json))
            $this->response_code = data_get($json,'response_code');
    }

}
