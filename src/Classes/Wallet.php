<?php


namespace Appino\Blockchain\Classes;


use Appino\Blockchain\Blockchain;
use Appino\Blockchain\Classes\Conversion\Conversion;
use Appino\Blockchain\Objects\AccountResponse;
use Appino\Blockchain\Objects\PaymentResponse;
use Appino\Blockchain\Exception\CredentialsError;
use Appino\Blockchain\Exception\ParameterError;

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
     * Create new Address
     * @param null|string $label
     * @return AccountResponse
     */

    public function CreateAddress($label = null){
        $params = array();
        if(!is_null($label))
            $params = ['label'=>$label];
        $response = $this->call('accounts/create',$params);
        return new AccountResponse($response);
    }

    /**
     * Get Account Balance
     *
     * @param $password string Main Wallet Password
     * @return int in satoshi
     */

    public function Balance(){
        $response = $this->call('balance');
        return $response['balance'];
    }

    /**
     * Get Specific Address Balance
     *
     * @param $address string Can be Index of Address or Xpub
     * @return int in satoshi
     */

    public function AddressBallance($param){
        $response = $this->call('accounts/'.$param.'/balance');
        return $response['balance'];
    }

    /**
     * Get Active Wallets
     * @return array<AccountResponse>
     */

    public function ActiveAddresses(){
        $addresses = $this->call('accounts');
        $response = array();
        foreach ($addresses as $address){
            $response[] = new AccountResponse($address);
        }
        return $response;
    }

    /**
     * Get Xpub List
     *
     * @return array<string> xpub address
     */

    public function XpubList(){
        $response = $this->call('accounts/xpubs');
        return $response;
    }

    /**
     * Get Single Wallet Data
     *
     * @param $param string Can be Index of Account or Xpub Address
     * @return AccountResponse
     */

    public function SingleAddress($param){
        $response = $this->call('accounts/'.$param);
        return new AccountResponse($response);
    }

    /**
     * Get Receiving Address
     *
     * @param $param string Can be Index of Account or Xpub Address
     * @return string
     */

    public function ReceivingAddress($param){
        $response = $this->call('accounts/'.$param.'/receiveAddress');
        return $response['address'];
    }

    /**
     * Archive Wallet
     *
     * @param $param string Can be Index of Account or Xpub Address
     * @return AccountResponse
     */

    public function ArchiveAddress($param){
        $response = $this->call('accounts/'.$param.'/archive');
        return new AccountResponse($response);
    }

    /**
     * UnArchive Wallet
     *
     * @param $param string Can be Index of Account or Xpub Address
     * @return AccountResponse
     */

    public function UnArchiveAddress($param){
        $response = $this->call('accounts/'.$param.'/unarchive');
        return new AccountResponse($response);
    }

    /**
     * Send Bitcoin to Address
     *
     * @param string $to bitcoin address that you want to send payment to
     * @param integer $amount amount of payment you want to send in satoshi
     * @param integer|string|null $from xpub address or index of account that you want to send payment from
     * @param integer|null $fee
     * @param integer|null $fee_per_byte
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
