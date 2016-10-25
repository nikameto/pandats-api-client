# PandaTS API client

[![Software License](https://img.shields.io/badge/license-MIT-brightgreen.svg?style=flat-square)](LICENSE)

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