<?php


namespace Appino\Blockchain\Classes;


use Appino\Blockchain\Objects\Rate;
use Appino\Blockchain\Objects\ReceiveResponse;

class Market{

    private $blockchain;

    public function __construct(Blockchain $blockchain){
        $this->blockchain = $blockchain;
    }

    const URL = 'https://blockchain.info/';

    private function Uri($uri){
        return self::URL.'/'.$uri;
    }

    /**
     * @param string $method
     * @param string $uri
     * @param array $params
     * @return array|string
     * @throws \Appino\Blockchain\Exception\HttpError
     */
    private function call($method, $uri, $params = array()){
        return $this->blockchain->Request($method, $this->Uri($uri), $params);
    }

    public function Rates(){
        $response = $this->call('GET','ticker');
        $rates = array();
        foreach ($response as $Currency => $params){
            $rates[$Currency] = new Rate($Currency, $params);
        }
        return $rates;
    }

    public function ToBTC($currency, $amount){
        $params = [
            'currency' => $currency,
            'value' => $amount
        ];
        $response = $this->call('GET','tobtc',$params);
        return new ReceiveResponse($response);
    }

    public function ToSatoshi($currency, $amount){
        $params = [
            'currency' => $currency,
            'value' => $amount
        ];
        return bcmul($this->call('GET','tobtc',$params),100000000);
    }

}
