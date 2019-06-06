# SentryDelegator
This is an expressive delegator for the service [Sentry](https://sentry.io) utilizing Sentry's latest PHP SDK. The only required config is your Sentry project DSN. You can optionally add an environment, which will automatically be registered in your expressive application. Below is an example config.

```php
return [
  'sentry' => [
    'dsn' => '[project dsn]',
    'environment' => '[environment]',
  ],
];
```

## Installation

You can install SentryDelegator using Composer:

```bash
$ composer require tigerman55/sentry-delegator
```

## Advanced Usage

Sentry context is supported with this delegator. To add context, simply add the following in the appropriate middleware:

```php
Sentry\configureScope(function (Scope $scope) use ($context) : void {
    $scope->setUser([
        'email'    => $context['email'],
        'username' => $context['username'],
    ]);
});
```