<?php

namespace Kevchikezie;

class Cryptographer
{
	/**
	 * Encrypt data using the public key. You also have the option to pass 
	 * the data to be encrypted as an array or string
	 *
	 * @param  string|array  $data
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
	 * Decrypt data value using the private key. You also have the 
	 * option to pass the data to be decrypted as an array or string
	 *
	 * @param  string|array  $data
	 * @param  string  $privateKey
	 * @return string|array
	 */
	public static function decrypt($data, string $privateKey)
	{
			if (is_array($data)) {
				$decrypted = [];

		        foreach ($data as $key => $value) {
		            $decrypted[$key] = self::decrypter($value, $privateKey);
		        }

		        return $decrypted;
		    }

		    return self::decrypter($data, $privateKey);
	}

	/**
	 * Generate a pair of private and public RSA key
	 * 
	 * @param  string  $bit
	 * @return array
	 */
	public function generate(string $bit = '2048')
	{
		$bit = intval($bit); // convert string to int
		$acceptedBits = [512, 1024, 2048, 4096];
		$bit = in_array($bit, $acceptedBits) ? $bit : 2048;

		$config = [
			'digest_alg' => 'sha512',
			'private_key_bits' => $bit,
			'private_key_type' => OPENSSL_KEYTYPE_RSA,
		];
		 
		$resource = openssl_pkey_new($config);

		// Extract private key from the pair
		openssl_pkey_export($resource, $privateKey);

		// Extract public key from the pair
		$keyDetails = openssl_pkey_get_details($resource);
		$publicKey = $keyDetails["key"];

		return [
			'private' => $privateKey, 
			'public' => $publicKey
		];
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

	/**
	 * Perform the decryption
	 *
	 * @param  string  $encryptedValue
	 * @param  string  $privateKey
	 * @return string
	 */
	private static function decrypter($encryptedValue, $privateKey)
	{
		if ($encryptedValue == '') return $encryptedValue;

		$encryptedValue = base64_decode($encryptedValue);
		
		// Format the private key to make it valid for the openssl_private_decrypt() function
		$privateKey = 	"-----BEGIN PRIVATE KEY-----\n" 
						. wordwrap($privateKey, 64, "\n", true) .
						"\n-----END PRIVATE KEY-----";

		openssl_private_decrypt($encryptedValue, $decrypted, $privateKey);

		return $decrypted;
	}

}
