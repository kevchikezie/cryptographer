<?php

namespace Kevchikezie;

class Cryptographer
{
	/**
	 * Encrypt a value using the public key. You also have the option to pass 
	 * the values to be encrypted as an array or string
	 *
	 * @param  string|array  $values
	 * @param  string  $publicKey
	 * @return string|array
	 */
	public static function encrypt($data, string $publicKey)
	{
			if (is_array($data)) {
				$encrypted = [];

		        foreach ($data as $key => $value) {
		            $encrypted[$key] = self::encrypter($value, $publicKey);
		        }

		        return $encrypted;
		    }

		    return self::encrypter($data, $publicKey);
	}

	/**
	 * Decrypt an encrypted value using the private key
	 *
	 * @param  string  $encryptedValue
	 * @param  string  $privateKey
	 * @return string
	 */
	public static function decrypt($encryptedValue, $privateKey)
	{
		$encryptedValue = base64_decode($encryptedValue);
		
		// Format the private key to make it valid for the openssl_private_decrypt() function
		$privateKey = 	"-----BEGIN PRIVATE KEY-----\n" 
						. wordwrap($privateKey, 64, "\n", true) .
						"\n-----END PRIVATE KEY-----";

		openssl_private_decrypt($encryptedValue, $decrypted, $privateKey);

		return $decrypted;
	}

	/**
	 * Perform the encryption
	 *
	 * @param  string  $value
	 * @param  string  $publicKey
	 * @return string
	 */
	private static function encrypter($value, $publicKey)
	{
		if ($value == '') return $value;

		// Format the public key to make it valid for the openssl_public_encrypt() function
		$publicKey = 	"-----BEGIN PUBLIC KEY-----\n" 
						. wordwrap($publicKey, 64, "\n", true) .
						"\n-----END PUBLIC KEY-----";

		openssl_public_encrypt($value, $encrypted, $publicKey);

		return base64_encode($encrypted);
	}

}
