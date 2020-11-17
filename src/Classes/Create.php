<?php
namespace Appino\Blockchain\Classes;

use Appino\Blockchain\Classes\Blockstream;
use Appino\Blockchain\Exception\ParameterError;
use Appino\Blockchain\Objects\WalletResponse;

class Create{

    protected $blockchain;
    const URL = '/api/v2/create';

    public function __construct(Blockstream $blockchain){
        $this->blockchain = $blockchain;
    }

    /**
     * Create new Wallet
     *
     * @param $password string
     * @param string|null $email
     * @param string|null $label
     * @return WalletResponse
     * @throws ParameterError
     */
    public function create($password, $email=null, $label=null) {
        $response = $this->doCreate($password, null, $email, $label);
        return new WalletResponse($response);
    }

    /**
     * Create new Wallet with specific private key
     *
     * @param string $password
     * @param string $privKey
     * @param string|null $email
     * @param string|null $label
     * @return WalletResponse
     * @throws ParameterError
     */
    public function createWithKey($password, $privKey, $email=null, $label=null) {
        if(!isset($privKey) || is_null($privKey))
            throw new ParameterError("Private Key required.");

        return new WalletResponse($this->doCreate($password, $privKey, $email, $label));
    }

    /**
     * Create new Wallet
     *
     * @param string $password
     * @param string|null $priv
     * @param string|null $label
     * @param string|null $email
     * @return array
     * @throws ParameterError
     */
    protected function doCreate($password, $priv = null, $label = null, $email = null){
        if(!isset($password) || empty($password))
            throw new ParameterError("Password required.");

        $params = array(
            'password'=>$password,
            'hd'=>true
        );
        if(!is_null($priv))
            $params['priv'] = $priv;
        if(!is_null($email))
            $params['email'] = $email;
        if(!is_null($label))
            $params['label'] = $label;

        return $this->blockchain->Request(Blockstream::POST,self::URL,$params);
    }

}
