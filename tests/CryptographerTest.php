<?php 

use PHPUnit\Framework\TestCase;
use Kevchikezie\Cryptographer;

class CryptographerTest extends TestCase
{
	protected $privateKey = "MIIBVQIBADANBgkqhkiG9w0BAQEFAASCAT8wggE7AgEAAkEAt9jKfaObXteXGEZY 8BwOjw5vTsERVe89BC5miQeNb8EdSsj6YMTRBz0gojDvwQOlDjQTykVPTyEI4kz3 Kixt+QIDAQABAkAnFpLG77gjDBd1888JDg4SYHFN/0KeUMVaVDs8uzxZHAvDFUio GBPEVgGsfrAwaX3aGFU34zVHVi1VIo5GSVwBAiEA3vSM7Gp7m1om3U15AUrQfgva udNejyHIhHkyslslljkCIQDTGF/GboBBdqwbhvqAD4Eeo5THt3jmRXXTwUFNbZ+V wQIgYNO4OBxuniNi6Y1x1dvV/EfNsBJZ6LN1UAMKv2bSRhECIQCrDt5Vmye9ZKAU 8m09ptK39FDVAj0rRHA1ty3mw4WFQQIhAMKRYiOaU+NLIoGmIi4jgOZ1zpa+iel3 yfzQ7Pmp6rUY";

	protected $publicKey = "MFwwDQYJKoZIhvcNAQEBBQADSwAwSAJBALfYyn2jm17XlxhGWPAcDo8Ob07BEVXv PQQuZokHjW/BHUrI+mDE0Qc9IKIw78EDpQ40E8pFT08hCOJM9yosbfkCAwEAAQ==";

	/** @test */
	public function  if_data_is_empty_return_empty_when_encrypting() 
	{
		// When the entire array is empty
		$array1 = [];
		$encrypted1 = Cryptographer::encrypt($array1, $this->publicKey);
		$arrayCount = count($encrypted1);

		$this->assertTrue($arrayCount == 0);

		// When some values in an associative array are empty
		$array2 = [
			'name' => 'John Doe',
			'age' => '',
			'email' => 'johdoe@mail.com',
		];
		$encrypted2 = Cryptographer::encrypt($array2, $this->publicKey);
		$stringLength1 = strlen($encrypted2['age']);

		$this->assertTrue($stringLength1 == 0);

		// When some values in an array are empty
		$array3 = ['blue', '', 'yellow'];
		$encrypted3 = Cryptographer::encrypt($array3, $this->publicKey);
		$stringLength2 = strlen($encrypted3[1]);

		$this->assertTrue($stringLength2 == 0);

		// When the parameter is a string
		$string = '';
		$encrypted4 = Cryptographer::encrypt($string, $this->publicKey);
		$stringLength3 = strlen($encrypted4);

		$this->assertTrue($stringLength3 == 0);
	}

	/** @test */
	public function  if_data_is_empty_return_empty_when_decrypting() 
	{
		// When the entire array is empty
		$array1 = [];
		$decrypted1 = Cryptographer::decrypt($array1, $this->privateKey);
		$arrayCount = count($decrypted1);

		$this->assertTrue($arrayCount == 0);

		// When some values in an associative array are empty
		$array2 = [
			'name' => 'IuUyQayCW2doEugs1SKKrZX/S8ZjKs++Ye2MqXIqQl3PNWQ8ATHionAHLABJceemadmBjcsaBPYU7gVYmulkKw==',
			'age' => '',
			'email' => 'sktDV3sh5NJRTDz0up/hSBP6h5Wbeg9PzNgArL1qp/crL4Z7ysijGVAvhJb6aOnZ7RoZxM8z4Ez3GqTzxRa8Vg==',
		];
		$decrypted2 = Cryptographer::decrypt($array2, $this->privateKey);
		$stringLength1 = strlen($decrypted2['age']);

		$this->assertTrue($stringLength1 == 0);

		// When some values in an array are empty
		$array3 = [
			'pfJjlfBzRPfJJe9RNDVi1JsYteZcXpccYBhNyYCWB6GrX2sNa44t9855uoZ6dtau31P/dJXxvOs6jKg3W7pdNw==', 
			'', 
			'tcdVw5wYvX8bZxeGTW9B1VhKALS8V85YWFhqpM6GO7Xfx5Ta8lz2xJZ/rgSiuUsoF8eWaTQ3V9s5PUSOxanHng=='
		];
		$decrypted3 = Cryptographer::decrypt($array3, $this->privateKey);
		$stringLength2 = strlen($decrypted3[1]);

		$this->assertTrue($stringLength2 == 0);

		// When the parameter is a string
		$string = '';
		$decrypted4 = Cryptographer::decrypt($string, $this->privateKey);
		$stringLength3 = strlen($decrypted4);

		$this->assertTrue($stringLength3 == 0);
	}

	/** @test */
	public function  ensure_data_is_encrypted_and_decrypted_correctly() 
	{
		// If data is a string
		$string = 'Hello World';
		$encryptedString = Cryptographer::encrypt($string, $this->publicKey);
		$decryptedString = Cryptographer::decrypt($encryptedString, $this->privateKey);

		$this->assertEquals($string, $decryptedString);

		// If data is an associative array
		$array = [
			'name' => 'John Doe',
			'age' => '20',
			'email' => 'johdoe@mail.com',
		];
		$encryptedArray = Cryptographer::encrypt($array, $this->publicKey);
		$decryptedArray1 = Cryptographer::decrypt($encryptedArray, $this->privateKey);

		$this->assertEquals($array, $decryptedArray1);
		$this->assertEquals($array['name'], $decryptedArray1['name']);
		$this->assertEquals($array['age'], $decryptedArray1['age']);
		$this->assertEquals($array['email'], $decryptedArray1['email']);

		// If data is an array
		$array = ['red', 'blue', 'yellow'];
		$encryptedArray = Cryptographer::encrypt($array, $this->publicKey);
		$decryptedArray2 = Cryptographer::decrypt($encryptedArray, $this->privateKey);

		$this->assertEquals($array, $decryptedArray2);
		$this->assertEquals($array[0], $decryptedArray2[0]);
		$this->assertEquals($array[1], $decryptedArray2[1]);
		$this->assertEquals($array[2], $decryptedArray2[2]);
	}

	/** @test */
	public function  generate_private_and_publoc_rsa_keys() 
	{
		$keys = Cryptographer::generate();
		$this->assertTrue(is_array($keys));
		$this->assertTrue(count($keys) == '2');
		$this->assertTrue(isset($keys['private']));
		$this->assertTrue(isset($keys['public']));
		$this->assertTrue(! empty($keys['private']));
		$this->assertTrue(! empty($keys['public']));
	}

}
