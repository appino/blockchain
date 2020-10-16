<?php


namespace Appino\Blockchain\Classes;


use Appino\Blockchain\Blockchain;
use Appino\Blockchain\Classes\Conversion\Conversion;
use Appino\Blockchain\Objects\AccountResponse;
use Appino\Blockchain\Objects\PaymentResponse;
use Blockchain\Exception\CredentialsError;
use Blockchain\Exception\ParameterError;

class Wallet{

    protected $blockchain;

    /**
     * @var string|null
     */
    private $identifier = null;
    /**
     * @var string|null
     */
    private $password = null;

    /**
     * Wallet constructor.
     * @param Blockchain $blockchain
     */
    public function __construct(Blockchain $blockchain){
        $this->blockchain = $blockchain;
    }

    /**
     * Generate Url
     *
     * @param $resource
     * @return string
     */
    private function URL($resource){
        return 'merchant/'.$this->identifier.'/'.$resource;
    }

    /**
     * Gets Access Credentials
     *
     * @param string $guid
     * @param string $password
     */
    public function credentials($guid, $password){
        $this->identifier = $guid;
        $this->password = $password;
    }

    /**
     * Check Access Credentials
     *
     * @throws CredentialsError
     */
    private function _checkCredentials() {
        if(is_null($this->identifier) || is_null($this->password)) {
            throw new CredentialsError('Please enter wallet credentials.');
        }
    }

    /**
     * Merge Params for Request
     *
     * @param array $extras
     * @return array
     */
    private function reqParams($extras=array()) {
        $ret = array('password'=>$this->password);
        return array_merge($ret, $extras);
    }

    /**
     * @param string $resource
     * @param array $params
     * @return array
     * @throws CredentialsError
     */

    private function call($resource, $params=array()) {
        $this->_checkCredentials();
        return $this->blockchain->Request('post', $this->URL($resource), $this->reqParams($params));
    }

    /**
     * Get Account Balance
     *
     * @param $password string Main Wallet Password
     * @return AccountResponse
     */

    public function Balance(){
        $response = $this->call('balance');
        return new AccountResponse($response);
    }

    /**
     * Get Specific Address Balance
     *
     * @param $address string Can be Index of Address or Xpub
     * @return AccountResponse
     */

    public function Address_Ballance($address){
        $response = $this->call('accounts/'.$address.'/balance');
        return new AccountResponse($response);
    }

    /**
     * Get Active Wallets
     * @return AccountResponse
     */

    public function ActiveWallets(){
        $response = $this->call('accounts');
        return new AccountResponse($response);
    }

    /**
     * Get Xpub List
     *
     * @return AccountResponse
     */

    public function XpubList(){
        $response = $this->call('accounts/xpubs');
        return new AccountResponse($response);
    }

    /**
     * Get Single Wallet Data
     *
     * @param $index string Can be Index of Account or Xpub Address
     * @return AccountResponse
     */

    public function SingleAddress($index){
        $response = $this->call('accounts/'.$index);
        return new AccountResponse($response);
    }

    /**
     * Get Receiving Address
     *
     * @param $index string Can be Index of Account or Xpub Address
     * @return AccountResponse
     */

    public function ReceivingAddress($index){
        $response = $this->call('accounts/'.$index.'/receiveAddress');
        return new AccountResponse($response);
    }

    /**
     * Archive Wallet
     *
     * @param $index string Can be Index of Account or Xpub Address
     * @return AccountResponse
     */

    public function ArchiveAddress($index){
        $response = $this->call('accounts/'.$index.'/archive');
        return new AccountResponse($response);
    }

    /**
     * UnArchive Wallet
     *
     * @param $index string Can be Index of Account or Xpub Address
     * @return AccountResponse
     */

    public function UnArchiveAddress($index){
        $response = $this->call('accounts/'.$index.'/unarchive');
        return new AccountResponse($response);
    }

    /**
     * Send Bitcoin to Address
     *
     * @param string $to bitcoin address that you want to send payment to
     * @param integer $amount amount of payment you want to send in satoshi
     * @param integer|string|null $from xpub address or index of account that you want to send payment from
     * @param null $fee
     * @return PaymentResponse
     * @throws ParameterError
     */

    public function SendPayment($to, $amount, $from=null, $fee=null, $fee_per_byte=null){
        if(!isset($amount))
            throw new ParameterError("Amount required.");

        $params = array(
            'to'=>$to,
            'amount'=>$amount
        );
        if(!is_null($from))
            $params['from'] = $from;
        if(!is_null($fee))
            $params['fee'] = $fee;
        if(!is_null($fee_per_byte))
            $params['fee_per_byte'] = $fee_per_byte;
        $response = $this->call('payment',$params);
        return new PaymentResponse($response);
    }

    /**
     * Send Bitcoin to multiple Addresses
     *
     * @param array<string,integer> $recipients recipients must be an array of address as key and satoshi as integer
     * @param integer|string|null $from xpub address or index of account that you want to send payment from
     * @param integer|null $fee must be in satoshi (better to set null or use fee_per_byte)
     * @param integer|null $fee_per_byte must be in satoshi
     */

    public function SendManyPayment($recipients, $from=null, $fee=null, $fee_per_byte = null){
        $params = array(
            'recipients'=>json_encode($recipients)
        );
        if(!is_null($from))
            $params['from'] = $from;
        if(!is_null($fee))
            $params['fee'] = $fee;
        if(!is_null($fee_per_byte))
            $params['fee_per_byte'] = $fee_per_byte;
        $response = $this->call('sendmany',$params);
        return new PaymentResponse($response);
    }

}
