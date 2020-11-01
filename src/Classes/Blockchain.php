<?php

namespace Appino\Blockchain\Classes;

use Appino\Blockchain\Classes\Create;
use Appino\Blockchain\Classes\Receive;
use Appino\Blockchain\Classes\Wallet;
use Appino\Blockchain\Exception\ApiError;
use Appino\Blockchain\Exception\Error;
use Appino\Blockchain\Exception\HttpError;
use Appino\Blockchain\Exception\ParameterError;
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
        $this->params['key'] = data_get($config,'api_code');
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
     * @return Market
     */
    public function Market(){
        return new Market($this);
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
     * @throws HttpError
     */

    public function Request($method, $url, $params){
        $params = array_merge($params, $this->params);
        switch ($method){
            case 'GET':
            case 'DELETE':
                $options = array('query'=>$params);
                break;
            case 'POST':
                $options = array(
                    'form_params'=>$params,
                    'headers'=>[
                        'Content-Type'=>'application/x-www-form-urlencoded',
                    ]
                );
                break;
            default:
                throw new ParameterError("request method not set");
        }
        try {
            $response = $this->client->request($method, $url, $options);
            $json = json_decode($response->getBody()->getContents(),true);
            if(is_null($json)) {
                // this is possibly a from btc request with a comma separation
                $json = json_decode(str_replace(',', '', $response));
                if (is_null($json))
                    throw new Error("Unable to decode JSON response from Blockchain: " . $response->getBody()->getContents());
            }
            if(array_key_exists('error', $json)) {
                throw new ApiError($json['error']);
            }
            return $json;
        } catch (GuzzleException $e) {
            echo $e->getMessage();
        }
    }

}
