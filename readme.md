# ems-api php client #

## Requirements ##

The only lib required is [Guzzle, PHP HTTP client](https://github.com/guzzle/guzzle).

## Installation ##

```bash
composer require emonsite/ems-api-php-client
```

## OpenAPI specification file ##

This PHP client lib was generated using the [openapi.json](./openapi.json) file located in the root directory.
Copy this file content in [editor.swagger.io](https://editor.swagger.io/) to see all the possibilities.

## Use ##

### Initialize the client ###

ems-api uses OAuth2 access authentication.

The first parameter must be a valid access token.
The second parameter is the API entry point url.
The third one is optional and is an array of headers that will be apply to every requests of the internal Guzzle client,
allowing to specify the accepted language for errors eg.


```php
/** @var \Emonsite\Api\ApiClient $apiClient */
$apiClient = new \Emonsite\Api\ApiClient(
    $token,
    'https://ems-api-entry-point.tld',
    ['Accept-Language' => 'en']
);
```

### Request resources with managers ###

Handle resources requesting with the main API client object like this :

```php
/** @var \Emonsite\Api\Resources\UserResponse $userResponse */
$userResponse = $apiClient->MeManager()->getUser();

/** @var \Emonsite\Api\Resources\User $me */
$me = $userResponse->data;
```

## TODO ##

More documentation to come with the first release...

Features to come :
- Link to the main documentation