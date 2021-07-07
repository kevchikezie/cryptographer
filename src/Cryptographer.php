<?php

namespace Kevchikezie;

class Cryptographer
{
	/**
	 * Encrypt a value using the public key
	 *
	 * @param  string  $value
	 * @param  string  $publicKey
	 * @return string
	 */
	public static function encrypt($value, $publicKey)
	{
		// Format the public key to make it valid for the openssl_public_encrypt() function
		$publicKey = 	"-----BEGIN PUBLIC KEY-----\n" 
						. wordwrap($publicKey, 64, "\n", true) .
						"\n-----END PUBLIC KEY-----";

		openssl_public_encrypt($value, $encrypted, $publicKey, OPENSSL_PKCS1_PADDING);

		return base64_encode($encrypted);
	}

	/**
	 * Decrypt an encrypted value using the RSA private key
	 *
	 * @param  string  $encryptedValue
	 * @param  string  $privateKey
	 * @return string
	 */
	public static function decrypt($encryptedValue, $privateKey)
	{
		$encryptedValue = base64_decode($encryptedValue);
		
		// Format the private key to make it valid for the openssl_private_decrypt() function
		$privateKey = 	"-----BEGIN RSA PRIVATE KEY-----\n" 
						. wordwrap($privateKey, 64, "\n", true) .
						"\n-----END RSA PRIVATE KEY-----";

		openssl_private_decrypt($encryptedValue, $decrypted, $privateKey, OPENSSL_PKCS1_PADDING);

		return $decrypted;
	}

}
