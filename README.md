#Blockchain v1 API

[![Latest Version on Packagist](https://img.shields.io/packagist/v/appino/blockchain.svg?style=flat-square)](https://packagist.org/packages/appino/blockchain)
[![Build Status](https://img.shields.io/travis/appino/blockchain/master.svg?style=flat-square)](https://travis-ci.org/appino/blockchain)
[![Quality Score](https://img.shields.io/scrutinizer/g/appino/blockchain.svg?style=flat-square)](https://scrutinizer-ci.com/g/appino/blockchain)
[![Total Downloads](https://img.shields.io/packagist/dt/appino/blockchain.svg?style=flat-square)](https://packagist.org/packages/appino/blockchain)

An unofficial PHP library for interacting with the blockchain.info API.
## Installation

In order to use this package you must provide an URL to an instance of service-my-wallet-v3. Before using these functionalities.[service-my-wallet-v3](https://github.com/blockchain/service-my-wallet-v3).

You can install the package via composer:

```bash
composer require appino/blockchain
```
###Add provider to app config
``` php
Appino\Blockchain\BlockchainServiceProvider::class
```
###Publish Configuration File
``` php
php artisan vendor:publish --provider="Appino\blockchain\BlockchainServiceProvider"
```
###Add 2 Lines to env File

```bash
blockchain_api_code=123456789abcdefghijklmnop //you must get api code from blockchain.info
blockchain_base_url=http://localhost:3000
```


## Usage
### Create
``` php
$blocchain = Blockchain::Create();
```
#### 1. Creating Wallet
``` php
/**
 * @param string $password
 * @param string|null $email
 * @param string|null $label
 * @return WalletResponse
 * @throws ParameterError
 */
$blockchain->create($password, $email, $label);
```
#### 2. Creating Wallet with specific private key
``` php
/**
 * @param string $password
 * @param string $privKey
 * @param string|null $email
 * @param string|null $label
 * @return WalletResponse
 * @throws ParameterError
 */
$blockchain->createWithKey($password, $privKey, $email, $label);
```
### Wallet
``` php
$blockchain = Blockchain::Wallet();
$blockchain->credentials($guid, $password);
```
#### 1. Create new Address
``` php
/**
 * @param null|string $label
 * @return AccountResponse
 */
$blockchain->CreateAddress($label));
```
#### 2. Balance
``` php
/**
 * @return int in satoshi
 */ 
$blockchain->balnce();
```
#### 3. Address Balance
``` php
/**
 * @param int|string $param can be index of address in wallet or address
 * @return int in satoshi
 */ 
$blockchain->AddressBallance($param);
```
#### 4. Active Addresses
Return list of addresses of a Wallet 
``` php
/**
 * @return array<AccountResponse>
 */ 
$blockchain->ActiveAddresses();
```
#### 5. List of Xpubs
Return list of xpub
``` php
/**
 * @return array<string>
 */ 
$blockchain->XpubList();
```
#### 6. Single Address Data
Return Single Address Data 
``` php
/**
 * @param int|string $param can be index of address in wallet or address
 * @return AccountResponse
 */ 
$blockchain->SingleAddress($param);
```
#### 7. Get Receiving Address
Return Receiving Address
``` php
/**
 * @param int|string $param can be index of address in wallet or address
 * @return string
 */ 
$blockchain->ReceivingAddress($param);
```
#### 8. Archive Address
``` php
/**
 * @param int|string $param can be index of address in wallet or address
 * @return AccountResponse
 */ 
$blockchain->ArchiveAddress($param);
```
#### 9. UnArchive Address
``` php
/**
 * @param int|string $param can be index of address in wallet or address
 * @return AccountResponse
 */ 
$blockchain->UnArchiveAddress($param);
```
#### 10. Send Payment
``` php
/**
 * @param string $to bitcoin address that you want to send payment to
 * @param integer $amount amount of payment you want to send in satoshi
 * @param integer|string|null $from xpub address or index of account that you want to send payment from
 * @param int|null $fee 
 * @param int|null $fee_per_byte 
 * @return PaymentResponse
 * @throws ParameterError
 */
$blockchain->SendPayment($to, $amount, $from, $fee, $fee_per_byte);
```
#### 11. Send Many Payment
``` php
/**
 * @param array<string,integer> $recipients recipients must be an array of address as key and satoshi as integer
 * @param integer|string|null $from xpub address or index of account that you want to send payment from
 * @param integer|null $fee must be in satoshi (better to set null or use fee_per_byte)
 * @param integer|null $fee_per_byte must be in satoshi
 * @return PaymentResponse
 * @throws ParameterError
 */
$blockchain->SendManyPayment($recipients, $from=null, $fee=null, $fee_per_byte = null);
```
### Receive
``` php
$blocchain = Blockchain::Receive();
```
#### 1. Generate Receiving Address
```` php
/**
 * @param string $xpub The public key.
 * @param string $callback The callback URL.
 * @param int $gap_limit How many unused addresses are allowed.
 * @return ReceiveResponse
 */
 $blockchain->Generate($xpub, $callback, $gap_limit = 20);
````
#### 2. Get Address Gap
```` php
/**
 * @param $xpub string
 * @return int
 * @throws \GuzzleHttp\Exception\GuzzleException
 */
 $blockchain->AddressGap($xpub);
````
#### 3. Balance Notification
```` php
/**
 * @param string $address
 * @param string $callback callback url
 * @param Notification|string $on what to do after notification called
 * @param int $confs how many confiramtion need to send notification
 * @param Operation|string $op on Receive/Send/All notification will send
 * @return NotificationResponse
 */
 $blockchain->BalanceNotification($address, $callback, $on, $confs, $op);
````
for deleting the notification use: 
```` php
/**
 * @param $id int
 * @return bool
 * @throws \GuzzleHttp\Exception\GuzzleException
 */
 $blockchain->DeleteBalanceNotification($id);
````
#### 4. Block Notification
```` php
/**
 * @param string $callback callback url
 * @param Notification|string $on what to do after notification called
 * @param int $confs how many confiramtion need to send notification
 * @param int|null $height height of block default(currentblock height  plus 1)
 * @return NotificationResponse
 * @throws \GuzzleHttp\Exception\GuzzleException
 */
 $blockchain->BlockNotification($callback, $on, $confs, $height);
````
for deleting the notification use: 
```` php
/**
 * @param int $id
 * @return bool
 * @throws \GuzzleHttp\Exception\GuzzleException
 */
 $blockchain->DeleteBlockNotification($id);
````
#### 5. Get CallBack Logs
```` php
/**
 * @param string $callback callback url
 * @return array<LogResponse>
 * @throws \GuzzleHttp\Exception\GuzzleException
 */
 $blockchain->CallbackLogs($callback);
````
### Changelog

Please see [CHANGELOG](CHANGELOG.md) for more information what has changed recently.

## Contributing

Please see [CONTRIBUTING](CONTRIBUTING.md) for details.

### Security

If you discover any security related issues, please email cyberman9000@gmail.com instead of using the issue tracker.

## Credits

- [Pouya Biglari](https://github.com/appino)
- [All Contributors](../../contributors)

## License

The MIT License (MIT). Please see [License File](LICENSE.md) for more information.
