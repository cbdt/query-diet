# Real-time query monitoring and discreet display of query count

[![Latest Version on Packagist](https://img.shields.io/packagist/v/cbdt/query-diet.svg?style=flat-square)](https://packagist.org/packages/cbdt/query-diet)
[![GitHub Code Style Action Status](https://img.shields.io/github/actions/workflow/status/cbdt/query-diet/fix-php-code-style-issues.yml?branch=main&label=code%20style&style=flat-square)](https://github.com/cbdt/query-diet/actions?query=workflow%3A"Fix+PHP+code+style+issues"+branch%3Amain)
[![Total Downloads](https://img.shields.io/packagist/dt/cbdt/query-diet.svg?style=flat-square)](https://packagist.org/packages/cbdt/query-diet)

This is where your description should go. Limit it to a paragraph or two. Consider adding a small example.

## Support us
## Installation

You can install the package via composer:

```bash
composer require cbdt/query-diet
```

You can publish the config file with:

```bash
php artisan vendor:publish --tag="query-diet-config"
```

This is the contents of the published config file:

```php
return [
    'enabled' => env('QUERY_DIET_ENABLED', true),
    'bad_query_time_ms' => env('QUERY_DIET_BAD_QUERY_TIME_MS', 100),
    'bad_query_count' => env('QUERY_DIET_BAD_QUERY_COUNT', 10),
];
```


## Usage

You'll see on the top right of your screen a small badge with the number of queries executed during the request.

## Credits

- [Clément Baudet](https://github.com/cbdt)

## License

The MIT License (MIT). Please see [License File](LICENSE.md) for more information.
