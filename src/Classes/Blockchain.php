<?php

namespace Appino\Blockchain\Classes;

use Appino\Blockchain\Classes\Create;
use Appino\Blockchain\Classes\Receive;
use Appino\Blockchain\Classes\Wallet;
use GuzzleHttp\Client;
use GuzzleHttp\Exception\GuzzleException;
use Illuminate\Contracts\Container\Container;

class Blockchain{

    protected $client;
    protected $params;
    public $HD = false;
    const GET = 'GET';
    const POST = 'POST';

    public function __construct($config){
        $this->client = new Client(['base_uri'=>data_get($config,'base_uri')]);
        $this->params['api_code'] = data_get($config,'api_code');
    }

    /**
     * Set the IoC Container.
     *
     * @param $container Container instance
     *
     * @return Blockchain
     */
    public function setContainer(Container $container): self{
        $this->container = $container;
        return $this;
    }

    /**
     * @return Create
     */
    public function Create(){
        return new Create($this);
    }

    /**
     * @return Wallet
     */
    public function Wallet(){
        return new Wallet($this);
    }

    /**
     * @return Receive
     */
    public function Receive(){
        return new Receive($this);
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
        $params = array_merge($params, $this->params);
        $options = array(
            'form_params'=>$params,
            'headers'=>[
                'Content-Type'=>'application/x-www-form-urlencoded',
            ]
        );
        try {
            $response = $this->client->request($method, $url, $options);
            return json_decode($response->getBody()->getContents(),true);
        } catch (GuzzleException $e) {
            echo $e->getMessage();
        }
    }

}
