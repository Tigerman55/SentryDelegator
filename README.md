# SentryDelegator
This is a mezzio delegator for the service [Sentry](https://sentry.io) utilizing Sentry's latest PHP SDK. The only required config is your Sentry project DSN. You can optionally add an environment, which will automatically be registered in your expressive application. Below is an example config.

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

## Configuration

To bind your configuration to Sentry, you'll need to invoke the following somewhere early in your application. One option, is to put this in index.php right after the container initialization.

```php
(new ConfigureSentry())($container->get('config'))
```

## Advanced Usage

You can roll your own error listener by implementing `ErrorListenerInterface`. I've also created `AsyncErrorListener` to flush errors for asynchronous applications such as react-php and swoole. You can utilize this in your config.

Sentry context is supported with this delegator. To add context, simply add the following in the appropriate middleware:

```php
Sentry\configureScope(function (Scope $scope) use ($context) : void {
    $scope->setUser([
        'email'    => $context['email'],
        'username' => $context['username'],
    ]);
});
```
