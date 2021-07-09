# Cryptographer

A minimal PHP library for RSA encryption and decryption. This library was built 
around the PHP OpenSSL extension.

## What can this library do?
The library has very minimal features which includes
- Encrypt data using a public RSA key 
- Decrypt data using a private RSA key 
- Generate a pair of private and public RSA keys 

## What do you need before you can use this library?
Before installing this library, ensure you have the requirements below;
- PHP >=7.0 (PHP 7.0 and above)
- PHP OpenSSL extention is already installed

## How do you use this library?
Install via composer
```bash
composer require kevchikezie/cryptographer
```

### Encrypt data using public RSA key

```php
use Kevchikezie\Cryptographer;

$plainValue = 'hello';

$publicKey = "MIIBIjANBgkqhkiG9w0BAQEFAAOCAQ8AMIIBCgKCAQEAzuQVNe0DQC5SCh31fsSa fki5Q7wCHN6LGEnPu9BRV6lX0SrLcGwyHuIOPGrGEDYkgqjAZmh1aMy1yh48WiyJ KUrPvkFx0SNIOjr8zkBCsiCLxsmO8W7+ESDrhejE/B1qtaEKOIjaa012/d5hbt+W QDQBoFy8w4uWrrg9z4iQPpNd5w/sfkOwM4jB2zQ0beEo7yR1+n6iMN4NKmleJseZ er9BLnpT65mDkBoLaWvQVAphknd9pzKymkukf0cA1BqRBeC8z3sGG7fyCdvhNnSV H3GNEsNl/QtCCEedV30xdJtTYMErD+5uwLv2JtGfnhV8SO/FJck1aU4V+hoRIvO1 rwIDAQAB";

$encryptedValue = Cryptographer::encrypt($plainValue, $publicKey);
var_dump($encryptedValue);

/*
# Returns
gKwBnIKJslYNrW8W7fDqiQddtl3NIOqauPo0KCOvdrn1OqyqbGJsuxPpc4FBjQt173zfaZAKduBehbYUVhZ83pobRXTo/HjWJv6mmftHkU1SqI47krNjIgBylVWv295G11nxGZH6eKGqdVuF5pVDGFUUZcRQhY/AM0tbfTfnqLMIDS12KE7rPVlRymLLGeereknXsLf7AmhYD8GIVwI/ozey4eOfXyn/Rf44xa2gruFdzTusHB64WNOY1YX/mjFTpPSSqRG5mMnw3bL4DKNC2fEB/Y0fx6F4xGCepXcuMV+otmaHLt+jaPnTJBJSmJAHHKaWsrM/H7Wvm+ayY3Y/Ww==
*/
```

You can also encrypt an array of data. If you pass an array of data to the 
`encrypt()` method, it returns an array of encrypted data.

```php
use Kevchikezie\Cryptographer;

$plainValues = [
	'name' => 'John Doe', 
	'email' => 'hello@johndoe.com'
];

$publicKey = "MIIBIjANBgkqhkiG9w0BAQEFAAOCAQ8AMIIBCgKCAQEAzuQVNe0DQC5SCh31fsSa fki5Q7wCHN6LGEnPu9BRV6lX0SrLcGwyHuIOPGrGEDYkgqjAZmh1aMy1yh48WiyJ KUrPvkFx0SNIOjr8zkBCsiCLxsmO8W7+ESDrhejE/B1qtaEKOIjaa012/d5hbt+W QDQBoFy8w4uWrrg9z4iQPpNd5w/sfkOwM4jB2zQ0beEo7yR1+n6iMN4NKmleJseZ er9BLnpT65mDkBoLaWvQVAphknd9pzKymkukf0cA1BqRBeC8z3sGG7fyCdvhNnSV H3GNEsNl/QtCCEedV30xdJtTYMErD+5uwLv2JtGfnhV8SO/FJck1aU4V+hoRIvO1 rwIDAQAB";

$encryptedValues = Cryptographer::encrypt($plainValues, $publicKey);
var_dump($encryptedValues);

/*
# Returns an array of encrypted data
[
	"name" => "f2fdeNgjlwqPURHRC0ddXHY29m6znEHyQkq76om8I3q/Ixx/CZcs1fmnuPRalVE9kYLG9RfP2cixo+wGTVNHWm5kR0dGVQ9rX0LdsKbe/VmVZSF40qZdszJJ90AN3+DXU+iMb6Zm4/zogwRI4IgmnVI6G1cGbHR7AKHycOY7DBxrMnkfc65zEpi0Vhhq/V7XZJ/KZy6SicSt0nWgoIrj6xjYM9UiejRQuxNobtJ+E15ypXqvyD276FTaouXQD3yyQ0brYAaFPh00jwGyV8hcRzmSo33fOHm8QBNtSScAKRDR42Vfmy29GQbeVjZNz7ObEL43QovAbtDiOwRt2noXTQ==", 

	"email" => "T9NknfUKZeMOF17YojRvFykr6vy6Zhygo/RspPW3DOTfMYKCgcdiCXIhv+jBMY/jSZDOyD8XZKx0Co3/Kc4KFMPkhNC/3mBDmXwUNL0msavs11HVtonpFnchggkjGd2Y3xjfkSXG2Ah585AGg8h+/YVrsxqWCOMMOxRwueHREycDSai6pQcbQBuHGYUpHrxIA7vWS03ygvQyHVu+84D5BUy3Bh0D0ix3qi9qP/+26fUK2OmH7cLMHUAilS2tZ05zLVO1LIZaMc+fUTMth2YmADYFcd2JzNuawMjm+qVkWYhcUvSqDWx2g6Sh4E2151YMDQ+aENlfnsTXVrvUxxpkyQ==" 
]
*/
```


### Decrypt data using private RSA key

```php
use Kevchikezie\Cryptographer;

$encryptedValue = "gKwBnIKJslYNrW8W7fDqiQddtl3NIOqauPo0KCOvdrn1OqyqbGJsuxPpc4FBjQt173zfaZAKduBehbYUVhZ83pobRXTo/HjWJv6mmftHkU1SqI47krNjIgBylVWv295G11nxGZH6eKGqdVuF5pVDGFUUZcRQhY/AM0tbfTfnqLMIDS12KE7rPVlRymLLGeereknXsLf7AmhYD8GIVwI/ozey4eOfXyn/Rf44xa2gruFdzTusHB64WNOY1YX/mjFTpPSSqRG5mMnw3bL4DKNC2fEB/Y0fx6F4xGCepXcuMV+otmaHLt+jaPnTJBJSmJAHHKaWsrM/H7Wvm+ayY3Y/Ww==";

$privateKey = "MIIEvQIBADANBgkqhkiG9w0BAQEFAASCBKcwggSjAgEAAoIBAQDO5BU17QNALlIK HfV+xJp+SLlDvAIc3osYSc+70FFXqVfRKstwbDIe4g48asYQNiSCqMBmaHVozLXK HjxaLIkpSs++QXHRI0g6OvzOQEKyIIvGyY7xbv4RIOuF6MT8HWq1oQo4iNprTXb9 3mFu35ZANAGgXLzDi5auuD3PiJA+k13nD+x+Q7AziMHbNDRt4SjvJHX6fqIw3g0q aV4mx5l6v0EuelPrmYOQGgtpa9BUCmGSd32nMrKaS6R/RwDUGpEF4LzPewYbt/IJ 2+E2dJUfcY0Sw2X9C0IIR51XfTF0m1NgwSsP7m7Au/Ym0Z+eFXxI78UlyTVpThX6 GhEi87WvAgMBAAECggEAXaRQkWLgiMkuatPajPExuBz0ddr/3c9Ah9LIyopkdtf4 Hn1PLWhbWy0YInJ1iVroNZdp1jBLjA6z7XK4AFyODHmHA+cdO/rLM0gFqtjdF0Cx 41zRbSe+qUQMNkT/+9jYtrLYLHSM3+plBE0GLqfWmuKvJcUzzxI8NoK/v1Jhb2B1 pWuTlQE5XNFXBqFQyMUcKuPWQaX0iiy20L7szajQfMTEyJfWB5wWgtqhjWD90+zI SufNXi3Qis+U2kmbjp6CoEdgTPsYLGfWgLyI+AEsH2w6HaxG9A6DuELZW2YaYBwp pqy6ngmlK46JTMkitJxogTcC4XaXVLemIqWI/Pca2QKBgQDwZjTyyX5Y04S6W6RC sMTWMW0De4gRHtVFnrn3ZF6hH86pf9UGmq05N+3HG1qXpzXthKDByGstauSr56qT aq2FcYiFNWCpU7OS3tuccx3YO072rNONws9oFWRafUFIL8N0gaqy3y9QK02U27ms ziGRzjZ+CX9IBSU3O8F9VIPmdQKBgQDcUTJxexRA4CS43jmRoZS5i4Ojbx/wSYZZ opMs90y40p0bZy6ANrHPgpkgK31bZTyIWux0NF1CDa7CuSCITUPIIISAtvEkk50p u6K11RKk0yXPgXAuHPbn7oh9vBfWrW3QrRA6LxHs2rNJEvDxqqtD5qZKU1QhTLqG TEGs/m3PEwKBgCUvGfeH1SQ2K2yL6j9qije7U2pbfDNxunlXUNqESuLPQa8UF8Y6 vJqCHSRUBdI5Se0gO6Fdt75Br3crkUXWFVrzsbMxC2+Fg9wu3nc3kyE0I0Wie+KM hHpL/MbGYwegY7IssFOUlAPpfsmMpw6kn6qm4+Tg4TApo5UEiCwzm2dVAoGBAKif vOv+N9Ivu+uCqq077ojUrzw3oUpX++w+8kZIQQB0sqp2nrCjLBSW8HwezSNWqK30 aWXHbllP/6Ip7yxjdq2FteSOIKLOGEwIwNBK9KoSsa3Qc/vXT2LUvsL9Y4F728EL tI/T1vRhrzcOuDs/VTXzIvNgM9QI1fpUAzBUy9bhAoGAfhnLkZZKppYOVuprwOO4 mvgv4H9JatHGn0BA3fXJNdKdzC0jVDwWQKukPSU7zXzRNMPkXSHVI9QsgQjrAkFd dY1JALe+Rj1qN0Cn4b6Jz01q9Nl2kti/pxJH8YjIml5gNvQokL/8yohco0V5tk16 vnX+E9I9EdcGiAGGpWq83rQ=";

$decryptedValue = Cryptographer::decrypt($encryptedValue, $privateKey);
var_dump($decryptedValue);

/*
# Returns
hello
*/
```

You can also decrypt an array of encrypted data. If you pass an array of 
encrypted data to the `decrypt()` method, it returns an array of decrypted data.

```php
use Kevchikezie\Cryptographer;

$encryptedValues = [
	"name" => "f2fdeNgjlwqPURHRC0ddXHY29m6znEHyQkq76om8I3q/Ixx/CZcs1fmnuPRalVE9kYLG9RfP2cixo+wGTVNHWm5kR0dGVQ9rX0LdsKbe/VmVZSF40qZdszJJ90AN3+DXU+iMb6Zm4/zogwRI4IgmnVI6G1cGbHR7AKHycOY7DBxrMnkfc65zEpi0Vhhq/V7XZJ/KZy6SicSt0nWgoIrj6xjYM9UiejRQuxNobtJ+E15ypXqvyD276FTaouXQD3yyQ0brYAaFPh00jwGyV8hcRzmSo33fOHm8QBNtSScAKRDR42Vfmy29GQbeVjZNz7ObEL43QovAbtDiOwRt2noXTQ==", 

	"email" => "T9NknfUKZeMOF17YojRvFykr6vy6Zhygo/RspPW3DOTfMYKCgcdiCXIhv+jBMY/jSZDOyD8XZKx0Co3/Kc4KFMPkhNC/3mBDmXwUNL0msavs11HVtonpFnchggkjGd2Y3xjfkSXG2Ah585AGg8h+/YVrsxqWCOMMOxRwueHREycDSai6pQcbQBuHGYUpHrxIA7vWS03ygvQyHVu+84D5BUy3Bh0D0ix3qi9qP/+26fUK2OmH7cLMHUAilS2tZ05zLVO1LIZaMc+fUTMth2YmADYFcd2JzNuawMjm+qVkWYhcUvSqDWx2g6Sh4E2151YMDQ+aENlfnsTXVrvUxxpkyQ==" 
];

$privateKey = "MIIEvQIBADANBgkqhkiG9w0BAQEFAASCBKcwggSjAgEAAoIBAQDO5BU17QNALlIK HfV+xJp+SLlDvAIc3osYSc+70FFXqVfRKstwbDIe4g48asYQNiSCqMBmaHVozLXK HjxaLIkpSs++QXHRI0g6OvzOQEKyIIvGyY7xbv4RIOuF6MT8HWq1oQo4iNprTXb9 3mFu35ZANAGgXLzDi5auuD3PiJA+k13nD+x+Q7AziMHbNDRt4SjvJHX6fqIw3g0q aV4mx5l6v0EuelPrmYOQGgtpa9BUCmGSd32nMrKaS6R/RwDUGpEF4LzPewYbt/IJ 2+E2dJUfcY0Sw2X9C0IIR51XfTF0m1NgwSsP7m7Au/Ym0Z+eFXxI78UlyTVpThX6 GhEi87WvAgMBAAECggEAXaRQkWLgiMkuatPajPExuBz0ddr/3c9Ah9LIyopkdtf4 Hn1PLWhbWy0YInJ1iVroNZdp1jBLjA6z7XK4AFyODHmHA+cdO/rLM0gFqtjdF0Cx 41zRbSe+qUQMNkT/+9jYtrLYLHSM3+plBE0GLqfWmuKvJcUzzxI8NoK/v1Jhb2B1 pWuTlQE5XNFXBqFQyMUcKuPWQaX0iiy20L7szajQfMTEyJfWB5wWgtqhjWD90+zI SufNXi3Qis+U2kmbjp6CoEdgTPsYLGfWgLyI+AEsH2w6HaxG9A6DuELZW2YaYBwp pqy6ngmlK46JTMkitJxogTcC4XaXVLemIqWI/Pca2QKBgQDwZjTyyX5Y04S6W6RC sMTWMW0De4gRHtVFnrn3ZF6hH86pf9UGmq05N+3HG1qXpzXthKDByGstauSr56qT aq2FcYiFNWCpU7OS3tuccx3YO072rNONws9oFWRafUFIL8N0gaqy3y9QK02U27ms ziGRzjZ+CX9IBSU3O8F9VIPmdQKBgQDcUTJxexRA4CS43jmRoZS5i4Ojbx/wSYZZ opMs90y40p0bZy6ANrHPgpkgK31bZTyIWux0NF1CDa7CuSCITUPIIISAtvEkk50p u6K11RKk0yXPgXAuHPbn7oh9vBfWrW3QrRA6LxHs2rNJEvDxqqtD5qZKU1QhTLqG TEGs/m3PEwKBgCUvGfeH1SQ2K2yL6j9qije7U2pbfDNxunlXUNqESuLPQa8UF8Y6 vJqCHSRUBdI5Se0gO6Fdt75Br3crkUXWFVrzsbMxC2+Fg9wu3nc3kyE0I0Wie+KM hHpL/MbGYwegY7IssFOUlAPpfsmMpw6kn6qm4+Tg4TApo5UEiCwzm2dVAoGBAKif vOv+N9Ivu+uCqq077ojUrzw3oUpX++w+8kZIQQB0sqp2nrCjLBSW8HwezSNWqK30 aWXHbllP/6Ip7yxjdq2FteSOIKLOGEwIwNBK9KoSsa3Qc/vXT2LUvsL9Y4F728EL tI/T1vRhrzcOuDs/VTXzIvNgM9QI1fpUAzBUy9bhAoGAfhnLkZZKppYOVuprwOO4 mvgv4H9JatHGn0BA3fXJNdKdzC0jVDwWQKukPSU7zXzRNMPkXSHVI9QsgQjrAkFd dY1JALe+Rj1qN0Cn4b6Jz01q9Nl2kti/pxJH8YjIml5gNvQokL/8yohco0V5tk16 vnX+E9I9EdcGiAGGpWq83rQ=";

$decryptedValues = Cryptographer::encrypt($encryptedValues, $privateKey);
var_dump($decryptedValues);

/*
# Returns an array of decrypted data
[
	'name' => 'John Doe', 
	'email' => 'hello@johndoe.com'
]
*/
```

### Generate a pair of private and public RSA keys
The `generate()` method returns an array containing the private and public RSA 
keys. The `generate()` method also accepts an optional parameter of the key size 
to be generated. The accepted bits are '512', '1024', '2048', '4096'. 
If a parameter is not provided, the default bits of 2048 is used.

```php
use Kevchikezie\Cryptographer;

$keys = Cryptographer::generate();
var_dump($keys);

/*
# Returns an array containing the private and public RSA keys
[
	"private" => "-----BEGIN PRIVATE KEY----- MIIEvQIBADANBgkqhkiG9w0BAQEFAASCBKcwggSjAgEAAoIBAQDD+qw31M0e5Gfa kgeR/ezMRF+EOMhmXQuAyr7oXksfzAHmDPLJLKtsg8cp6ToGuZ8uEzrqer5t7rLy m90EtKTvWtV7vg3Tk/lySXTMOUiOOAttms4Re5/nd5Oees7n7YDbHQ0cVEwhrFbf k4J0nV7SnUFV/RFTpgBOHDpFlT6zsJWLI7QPfjzCbza2YzSiuna4zn0xsjJCf23I XwXmehy+VBl8YGuyPJPxqiPMkd2HLNvc97SfSTi+0O5Y4UXBeDuuKAq/b8P80MM5 JD3/x6rH+wYGUJ3XJYwg+4yRnqpm/q16p9qLloVz9jR/8Cb1z06c3rB5eaKnlGbP w08uZKoRAgMBAAECggEAWrl57mK6DnoIRdviW0hkze89FJXA1/ps79Nr62BzgKXN nzURU+Y0+YhLs/A/J4vYz9ihJplp/LRK7RsQhzQlQpUXTTCfb/oJuUmeI0jFeOkj CTtn+Bn13Y6yrOQHUsDVLRpWzm2LzO7eTKQZ+Wg81F1uOKNt2P55F6/jngDIRSBC 3fQTdg3o6664T2FlWjcKjBSwZhNIMehSRkpj2h6wKwDNNvFbX0Lw167Bj0Zu7sDN cymQJu/EyXBhNG7C4fyvnCPKkI705H71mnTd99HO0ZeTOo52lM0y6c7hegSxFbBe Er7rB1gGKaA0IWd70FKYf/lIlEodZsJE9nD6+hmCAQKBgQD2B3dtdrbmz5KIiP1P ktUYH87i/yHYv7/MEwXzEshLIbk+YDvAGguTpm2QLa+jyzGKnAghKIytxtJrIkxE NDtmU8oG82bMmh5X0QkVGz2ZTkgMBkV373yWBKKMFmTIMzF6uSjSXXHkHvLmQDsG JQRqTgdc6VguBt3TIN1UvroXoQKBgQDL6/EM3xbY2b7EjdRtGkEmx4Pa8bQqpyvF dqGYyLh9peDl1A1/NsOIyA3/No535TZBR+WmepOSARbELcgR8L3yR6X+SuD7voDj Q8SmYpRSzqy75T9CiGN6Gya1hxAsfLXaNOk5078byXzdhUyA99K9m0hbY3zmjvq1 IBgp8ya8cQKBgQDMe6wxWMfv0noR7PnM11cxc856MF8rTUPWE8GQI/5BI8hZJZbD tWIF1/+cI7ylwE5uy/ydwpwaGvPsg1csINV12RJC8K5yQ24QwvZvinKKJtwO0m+O nYfJEBUhpcMh+hqXy6k4Ht54IZj08lGca8vdpvjLqk3WA3L+9YO/2b3FwQKBgGWO BSgB2iD4n9bHQ2lqT9P+PJ5HDRDI3DWk1Ol/3NFGUPBkYKxgG5T8/GuDQgRXtGNi aO410VQ/EpV0r1Sv7gjAwdwYcl8tCocj8sViBrgOkVup2Y1K2y+uYeK5dsaQ/QfE nfnciCpQd8ziW61Gvj8LHEfXDhbMUfLuHtqVa08hAoGAT9buuqRIwSISxhoJCUPW /P3lhTvMKu35tvzf9y2MkEbXuorTo9vP+TXRJJCBX1o4Krg+Cw814lFs6RfnxC3q kbjBBwQ+d2UomnNZkbzpAJj3VWpn72ClYkzmHSWjMDDVO1BVFvCDt+IlTe0tk7/J zEWFkqltl736ZF6gGGneU0U= -----END PRIVATE KEY----- ", 

	'public' => "-----BEGIN PUBLIC KEY----- MIIBIjANBgkqhkiG9w0BAQEFAAOCAQ8AMIIBCgKCAQEAw/qsN9TNHuRn2pIHkf3s zERfhDjIZl0LgMq+6F5LH8wB5gzyySyrbIPHKek6BrmfLhM66nq+be6y8pvdBLSk 71rVe74N05P5ckl0zDlIjjgLbZrOEXuf53eTnnrO5+2A2x0NHFRMIaxW35OCdJ1e 0p1BVf0RU6YAThw6RZU+s7CViyO0D348wm82tmM0orp2uM59MbIyQn9tyF8F5noc vlQZfGBrsjyT8aojzJHdhyzb3Pe0n0k4vtDuWOFFwXg7rigKv2/D/NDDOSQ9/8eq x/sGBlCd1yWMIPuMkZ6qZv6teqfai5aFc/Y0f/Am9c9OnN6weXmip5Rmz8NPLmSq EQIDAQAB -----END PUBLIC KEY----- "
]
*/
```

You can also pass a parameter to the `generate()` method

```php
use Kevchikezie\Cryptographer;

$keys = Cryptographer::generate('512'); //'512', '1024', '2048', '4096'
var_dump($keys);

/*
# Returns an array containing the private and public RSA keys
[
	"private" => "-----BEGIN PRIVATE KEY----- MIIBVQIBADANBgkqhkiG9w0BAQEFAASCAT8wggE7AgEAAkEAt9jKfaObXteXGEZY 8BwOjw5vTsERVe89BC5miQeNb8EdSsj6YMTRBz0gojDvwQOlDjQTykVPTyEI4kz3 Kixt+QIDAQABAkAnFpLG77gjDBd1888JDg4SYHFN/0KeUMVaVDs8uzxZHAvDFUio GBPEVgGsfrAwaX3aGFU34zVHVi1VIo5GSVwBAiEA3vSM7Gp7m1om3U15AUrQfgva udNejyHIhHkyslslljkCIQDTGF/GboBBdqwbhvqAD4Eeo5THt3jmRXXTwUFNbZ+V wQIgYNO4OBxuniNi6Y1x1dvV/EfNsBJZ6LN1UAMKv2bSRhECIQCrDt5Vmye9ZKAU 8m09ptK39FDVAj0rRHA1ty3mw4WFQQIhAMKRYiOaU+NLIoGmIi4jgOZ1zpa+iel3 yfzQ7Pmp6rUY -----END PRIVATE KEY----- ", 

	'public' => "-----BEGIN PUBLIC KEY----- MFwwDQYJKoZIhvcNAQEBBQADSwAwSAJBALfYyn2jm17XlxhGWPAcDo8Ob07BEVXv PQQuZokHjW/BHUrI+mDE0Qc9IKIw78EDpQ40E8pFT08hCOJM9yosbfkCAwEAAQ== -----END PUBLIC KEY----- "
]
*/
```

## License
The Cryptographer library is open-sourced software licensed under the 
[MIT license](https://opensource.org/licenses/MIT)
