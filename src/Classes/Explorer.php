<?php


namespace Appino\Blockchain\Classes;


use Appino\Blockchain\Interfaces\ChartType;
use Appino\Blockchain\Objects\Address;
use Appino\Blockchain\Objects\AddressBalance;
use Appino\Blockchain\Objects\Block;
use Appino\Blockchain\Objects\LatestBlock;
use Appino\Blockchain\Objects\MultiAddress;
use Appino\Blockchain\Objects\Transaction;
use Appino\Blockchain\Objects\UnspentOutput;

class Explorer{

    private $blockchain;

    public function __construct(Blockchain $blockchain){
        $this->blockchain = $blockchain;
    }

    const URL = 'https://blockchain.info';

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

    /**
     * @param string $hash
     * @return Block
     * @throws \Appino\Blockchain\Exception\HttpError
     */
    public function Block($hash){
        return new Block($this->call(Blockchain::GET,'rawblock/'.$hash));
    }

    /**
     * @param string $txid
     * @return Transaction
     * @throws \Appino\Blockchain\Exception\HttpError
     */
    public function Transaction($txid){
       return new Transaction($this->call(Blockchain::GET,'rawtx/'.$txid));
    }

    /**
     * @param integer $height
     * @return array
     * @throws \Appino\Blockchain\Exception\HttpError
     */
    public function BlockHeight($height){
        $response = ($this->call(Blockchain::GET,'block-height/'.$height,['format'=>'json']))['blocks'];
        $blocks = [];
        foreach ($response as $value){
            $blocks[] = new Block($value);
        }
        return $blocks;
    }

    /**
     * @param string $address can be base58 or hash160
     * @return Address
     * @throws \Appino\Blockchain\Exception\HttpError
     */
    public function Address($address){
        return new Address($this->call(Blockchain::GET,'rawaddr/'.$address));
    }

    /**
     * @param array $addresses
     * @return MultiAddress can be base58 or xpub
     * @throws \Appino\Blockchain\Exception\HttpError
     */
    public function MultiAddress($addresses=array()){
        return new MultiAddress($this->call(Blockchain::GET,'multiaddr',['active'=>implode("|",$addresses)]));
    }

    /**
     * @param array $addresses can be base58 or xpub
     * @param int $limit to show n transactions (Default: 250, Max: 1000)
     * @param int $confirmations confirmations parameter to limit the minimum confirmations
     * @return array
     * @throws \Appino\Blockchain\Exception\HttpError
     */
    public function UnspentOutputs($addresses, $limit=250, $confirmations=0){
        $response = $this->call(Blockchain::GET,'unspent',['active'=>implode("|",$addresses), 'limit'=>$limit, 'confirmations'=>$confirmations]);
        $UnspentOutputs = [];
        foreach ($response['unspent_outputs'] as $value){
            $UnspentOutputs[] = new UnspentOutput($value);
        }
        return $UnspentOutputs;
    }

    /**
     * @param array $addresses can be base58 or xpub
     * @return array
     * @throws \Appino\Blockchain\Exception\HttpError
     */
    public function Balance($addresses){
        $response = $this->call(Blockchain::GET,'balance',['active'=>implode("|",$addresses)]);
        $balances = [];
        foreach ($response as $key => $value){
            $balances[] = new AddressBalance($key, $value);
        }
        return $balances;
    }

    /**
     * @return LatestBlock
     * @throws \Appino\Blockchain\Exception\HttpError
     */
    public function LatestBlock(){
        return new LatestBlock($this->call(Blockchain::GET,'latestblock'));
    }

    /**
     * @return array
     * @throws \Appino\Blockchain\Exception\HttpError
     */
    public function UnconfirmedTransactions(){
        $response = $this->call(Blockchain::GET,'unconfirmed-transactions',['format'=>'json']);
        $transactions = [];
        foreach ($response['txs'] as $tx){
            $transactions[] = new Transaction($tx);
        }
        return $transactions;
    }

}
