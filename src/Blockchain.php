<?php

namespace Appino\Blockchain;

use Appino\Blockchain\Classes\Create;
use Appino\Blockchain\Classes\Receive;
use Appino\Blockchain\Classes\Wallet;
use GuzzleHttp\Client;
use GuzzleHttp\Exception\GuzzleException;

class Blockchain{

    protected $client;
    protected $params;
    public $HD = false;
    const GET = 'GET';
    const POST = 'POST';

    public function __construct($config){
        $this->client = new Client(['base_uri'=>data_get($config,'base_uri')]);
        $this->params['api_code'] = data_get('api_code',null);
        $this->Create = new Create($this);
        $this->Wallet = new Wallet($this);
        $this->Receive = new Receive($this);
    }

    /**
     * @param $base_uri string Default : http://localhost:3000
     */

    public function newBaseUri($base_uri){
        $this->client = new Client(['base_uri'=>$base_uri]);
    }

    /**
     * @param $method
     * @param $url
     * @param $params
     * @return array
     */

    public function Request($method, $url, $params){
        $params = array_merge($this->params, $params);
        $options = array(
            'form-params'=>$params,
            'headers'=>[
                'Content-Type'=>'application/x-www-form-urlencoded',
            ]
        );

        try {
            return json_decode($this->client->request($method, $url, $options),true);
        } catch (GuzzleException $e) {
            //throw $e->getMessage();
        }
    }

}
