<?php


namespace Appino\Blockchain\Classes;


use Appino\Blockchain\Blockchain;
use Appino\Blockchain\Interfaces\Notification;
use Appino\Blockchain\Interfaces\Operation;
use Appino\Blockchain\Objects\LogResponse;
use Appino\Blockchain\Objects\NotificationResponse;
use Appino\Blockchain\Objects\ReceiveResponse;
use GuzzleHttp\Client;

class Receive{
    /**
     * @var Blockchain
     */
    private $blockchain;
    /**
     * @var array
     */
    private $params;
    const URL = 'https://api.blockchain.info/v2/receive';


    /**
     * Receive constructor.
     * @param Blockchain $blockchain
     */

    public function __construct($config){
        $this->client = new Client(['base_uri'=>self::URL]);
        $this->params = [
            'key'=>data_get('api_code',null)
        ];
    }

    /**
     * Generates a receive address.
     *
     * @param string $xpub The public key.
     * @param string $callback The callback URL.
     * @param int $gap_limit How many unused addresses are allowed.
     * @return ReceiveResponse
     */
    public function Generate($xpub, $callback, $gap_limit = 20){
        $params = [
            'xpub' => $xpub,
            'callback' => $callback,
            'gap_limit' => $gap_limit
        ];
        $params = array_merge($this->params, $params);
        $response = json_decode($this->client->get('',['query'=>$params]),true);
        return new ReceiveResponse($response);
    }

    /**
     * Get the xpub gap
     *
     * @param $xpub string
     * @return integer
     * @throws \GuzzleHttp\Exception\GuzzleException
     */
    public function AddressGap($xpub){
        $params = array_merge(['xpub'=>$xpub],$this->params);
        $response = json_decode($this->client->get('checkgap',['query'=>$params]),true);
        return $response['gap'];
    }

    /**
     * This method monitors an address of your choice for received and / or spent payments.
     * You will be sent an HTTP notification immediately when a transaction is made,
     * and subsequently when it reaches the number of confirmations specified in the request.
     *
     * @param string $address
     * @param string $callback
     * @param Notification|string $on
     * @param int $confs
     * @param Operation|string $op
     * @return NotificationResponse
     */

    public function BalanceNotification($address, $callback, $on = Notification::KEEP, $confs = 3, $op = Operation::ALL){
        $params = [
            'address' => $address,
            'callback' => $callback,
            'onNotification' => $on,
            'confs' => $confs,
            'op' => $op
        ];
        $params = array_merge($this->params, $params);
        $response = json_decode($this->client->post('balance_update',['form_params'=>$params]),true);
        return new NotificationResponse($response);
    }

    /**
     * This method delete the balance notification
     *
     * @param $id int
     * @return bool
     * @throws \GuzzleHttp\Exception\GuzzleException
     */

    public function DeleteBalanceNotification($id){
       $response = json_decode($this->client->delete('balance_update/'.$id, ['query'=>$this->params]),true);
       return $response['deleted'];
    }

    /**
     * This method allows you to request callbacks when a new block of a specified height and confirmation number is added to the blockchain.
     *
     * @param $callback string
     * @param string $on
     * @param int $confs
     * @param int|null $height
     * @return NotificationResponse
     * @throws \GuzzleHttp\Exception\GuzzleException
     */

    public function BlockNotification($callback, $on = Notification::KEEP, $confs = 1, $height = null){
        $params = [
            'callback' => $callback,
            'onNotification' => $on,
            'confs' => $confs,
        ];
        if(!is_null($height))
            $params['height'] = $height;
        $params = array_merge($this->params, $params);
        $response = json_decode($this->client->post('block_notification',['form_params'=>$params]),true);
        return new NotificationResponse($response);
    }

    /**
     * This method delete block notification
     *
     * @param $id int
     * @return bool
     * @throws \GuzzleHttp\Exception\GuzzleException
     */

    public function DeleteBlockNotification($id){
        $response = json_decode($this->client->delete('block_notification/'.$id,['query'=>$this->params]),true);
        return $response['deleted'];
    }

    /**
     * See logs related to callback attempts.
     *
     * @param $callback string
     * @return LogResponse
     * @throws \GuzzleHttp\Exception\GuzzleException
     */

    public function CallbackLogs($callback){
        $params = array_merge(['callback'=>$callback],$this->params);
        $response = json_decode($this->client->get('callback_log',['query'=>$params]),true);
        return new LogResponse($response);
    }

}
