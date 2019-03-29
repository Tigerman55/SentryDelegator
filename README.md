# SentryDelegator
This is an expressive delegator for the service [Sentry](https://sentry.io) utilizing Sentry's latest PHP SDK. The only required config is your Sentry project DSN. You can optionally add an environment, which will automatically be registered in your expressive application. Below is an example config.

```php
return [
  'sentry' => [
    'dsn' => '[project dsn]',
    'environment' => '[environment]',
  ],
];
