# Query Diet: Explore queries that have a bad diet

[![Latest Version on Packagist](https://img.shields.io/packagist/v/cbdt/query-diet.svg?style=flat-square)](https://packagist.org/packages/cbdt/query-diet)
[![GitHub Code Style Action Status](https://img.shields.io/github/actions/workflow/status/cbdt/query-diet/fix-php-code-style-issues.yml?branch=main&label=code%20style&style=flat-square)](https://github.com/cbdt/query-diet/actions?query=workflow%3A"Fix+PHP+code+style+issues"+branch%3Amain)
[![Total Downloads](https://img.shields.io/packagist/dt/cbdt/query-diet.svg?style=flat-square)](https://packagist.org/packages/cbdt/query-diet)

Query monitoring and discreet display of query count and execution time in the Laravel app.

This is a Query Diet having a good diet (6 queries, 0.5ms):

![How it looks when there is a bad query diet](/example_good_diet.png)

This is a Query Diet having a bad diet (28 queries, 79ms):

![How it looks when there is a bad query diet](/example_bad_diet.png)


This project is a port of the Ruby gem [query_diet](https://github.com/makandra/query_diet) to Laravel.

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
