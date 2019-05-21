Curler
==

cURL helper for PHP

[![Build Status](https://travis-ci.org/wernerdweight/Curler.svg?branch=master)](https://travis-ci.org/wernerdweight/Curler)
[![Latest Stable Version](https://poser.pugx.org/wernerdweight/curler/v/stable)](https://packagist.org/packages/wernerdweight/curler)
[![Total Downloads](https://poser.pugx.org/wernerdweight/curler/downloads)](https://packagist.org/packages/wernerdweight/curler)
[![License](https://poser.pugx.org/wernerdweight/curler/license)](https://packagist.org/packages/wernerdweight/curler)

Instalation
--

1) Download using composer

```bash
composer require wernerdweight/curler
```

2) Use in your project

```php
use WernerDweight\Curler\Curler;
use WernerDweight\Curler\Request;

$curler = new Curler();
$request = (new Request())
    ->setEndpoint('https://some-website.tld')
    ->setMethod('POST')
    ->setPayload(['key' => 'value'])
    ->setHeaders(['Accept: text/html', 'Accept-Encoding: gzip'])
    ->setAuthentication('user', 'password')
;
$response = $curler->request($request);
echo $response->getResponse();  // '<html>...</html>'
var_dump($response->getMetaData()); // array of response metadata (content-type, status...)
```

API
--

#### Curler
* **`request(Request $request): Response`**  \
Allows to fetch data according to given `$request`.

#### Request
* **`setEndpoint(string $endpoint): self`**
* **`getEndpoint(): ?string`**
* **`setMethod(string $method): self`**
* **`getMethod(): ?string`**
* **`setPayload(array $payload): self`**
* **`getPayload(): ?array`**
* **`setHeaders(array $headers): self`**
* **`addHeader(string $header): self`**
* **`removeHeader(string $header): bool`**
* **`getHeaders(): ?array`**
* **`setAuthentication(string $user, string $password): self`**
* **`getAuthentication(): ?array`**

#### Response
* **`getResponse(): string`**
* **`getJsonResponse(): WernerDweight\RA\RA`**
* **`getMetaData(): WernerDweight\RA\RA`**
