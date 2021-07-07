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
	
}
