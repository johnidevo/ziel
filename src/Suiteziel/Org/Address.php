<?php
namespace App\Suiteziel\Org;


use Sop\CryptoTypes\Asymmetric\EC\ECPublicKey;
use Sop\CryptoTypes\Asymmetric\EC\ECPrivateKey;
use Sop\CryptoEncoding\PEM;
use kornrunner\keccak;

class Address
{
	public $aConfig;
	public $oOpaque;
	public $sKeyPrivate;
	
	public function __construct () {
		$this->aConfig = array(
			'private_key_type' => OPENSSL_KEYTYPE_EC,
			'curve_name' => 'secp256k1'
		);
		$this->oOpaque = openssl_pkey_new($this->aConfig);
		if (!$this->oOpaque) die('ERROR: Fail to generate private key. -> ' . openssl_error_string());
		$this->generate_keys();
	}
	
	public function generate_keys () {
		// Generate Private Key
		openssl_pkey_export($this->oOpaque, $sKeyPrivate);

		// Get The Public Key
		$key_detail = openssl_pkey_get_details($sKeyPrivate);
		$pub_key = $key_detail;

		$priv_pem = PEM::fromString($priv_key);
		
		
// Convert to Elliptic Curve Private Key Format
$ec_priv_key = ECPrivateKey::fromPEM($priv_pem);

// Then convert it to ASN1 Structure
$ec_priv_seq = $ec_priv_key->toASN1();

// Private Key & Public Key in HEX
$priv_key_hex = bin2hex($ec_priv_seq->at(1)->asOctetString()->string());
$priv_key_len = strlen($priv_key_hex) / 2;
$pub_key_hex = bin2hex($ec_priv_seq->at(3)->asTagged()->asExplicit()->asBitString()->string());
$pub_key_len = strlen($pub_key_hex) / 2;

// Derive the Ethereum Address from public key
// Every EC public key will always start with 0x04,
// we need to remove the leading 0x04 in order to hash it correctly
$pub_key_hex_2 = substr($pub_key_hex, 2);
$pub_key_len_2 = strlen($pub_key_hex_2) / 2;

// Hash time
$hash = Keccak::hash(hex2bin($pub_key_hex_2), 256);

// Ethereum address has 20 bytes length. (40 hex characters long)
// We only need the last 20 bytes as Ethereum address
$wallet_address = '0x' . substr($hash, -40);
$wallet_private_key = '0x' . $priv_key_hex;

echo "\r\n   ETH Wallet Address: " . $wallet_address;
echo "\r\n   Private Key: " . $wallet_private_key;
		
		
	}
	
	
}

/*
$private_key = openssl_pkey_new();
$public_key_pem = openssl_pkey_get_details($private_key)['key'];
echo $public_key_pem;
$public_key = openssl_pkey_get_public($public_key_pem);
var_dump($public_key);
*/



/*




*/
?>