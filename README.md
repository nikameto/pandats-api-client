# PandaTS API client

[![Software License](https://img.shields.io/badge/license-MIT-brightgreen.svg?style=flat-square)](LICENSE)
[![Build Status](https://img.shields.io/travis/resnext/pandats-api-client.svg?style=flat-square&branch=master)](https://travis-ci.org/resnext/pandats-api-client)
[![Code Coverage](https://img.shields.io/codecov/c/gh/resnext/pandats-api-client.svg?style=flat-square)](https://codecov.io/gh/resnext/pandats-api-client)
[![Packagist](https://img.shields.io/packagist/v/resnext/pandats-api-client.svg?style=flat-square)](https://packagist.org/packages/resnext/pandats-api-client)

## Registration

```php
$apiClient = new \Panda\ApiClient($url, <Partner ID>, 'Secret key');

$request = new \Panda\Requests\RegistrationRequest([
    'email' => 'john.smith@domain.com',
    'password' => 'qwerty',
    'firstName' => 'John',
    'lastName' => 'Smith',
    'phoneNumber' => '1231231231',
    'source' => '<Source ID>',
    'country' => 'GB',
    'ipAddress' => '78.138.111.152',
]);

/** @var \Panda\Responses\RegistrationResponse $response */
$response = $apiClient->registration($request);
```