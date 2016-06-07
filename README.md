# Laravel 5 Tradeoff Analytics

[![StyleCI](https://styleci.io/repos/59981815/shield?style=flat)](https://styleci.io/repos/59981815)
[![Build Status](https://travis-ci.org/findbrok/laravel-tradeoff-analytics.svg?branch=master)](https://travis-ci.org/findbrok/laravel-tradeoff-analytics)
[![Latest Stable Version](https://poser.pugx.org/findbrok/laravel-tradeoff-analytics/v/stable)](https://packagist.org/packages/findbrok/laravel-tradeoff-analytics) 
[![Total Downloads](https://poser.pugx.org/findbrok/laravel-tradeoff-analytics/downloads)](https://packagist.org/packages/findbrok/laravel-tradeoff-analytics) 
[![Latest Unstable Version](https://poser.pugx.org/findbrok/laravel-tradeoff-analytics/v/unstable)](https://packagist.org/packages/findbrok/laravel-tradeoff-analytics) 
[![License](https://poser.pugx.org/findbrok/laravel-tradeoff-analytics/license)](https://packagist.org/packages/findbrok/laravel-tradeoff-analytics)

A simple Laravel 5 wrapper around [IBM Watson Tradeoff Analytics API](http://www.ibm.com/smarterplanet/us/en/ibmwatson/developercloud/tradeoff-analytics.html)

## How it works

Tradeoff Analytics is a Watson service that helps people make decisions when balancing multiple objectives. The service uses a mathematical filtering technique called “Pareto Optimization,” that enables users to explore tradeoffs when considering multiple criteria for a single decision.

## Intended Use

Tradeoff Analytics can help bank analysts or wealth managers select the best investment strategy based on performance attributes, risk, and cost. It can help consumers purchase the product that best matches their preferences based on attributes like features, price, or warranties. Additionally, Tradeoff Analytics can help physicians find the most suitable treatment based on multiple criteria such as success rate, effectiveness, or adverse effects.

## Installation

Install the package through composer

```
composer require findbrok/laravel-tradeoff-analytics
```

Add the Service Provider to your providers array in ```config/app.php```, see [Registering Providers](https://laravel.com/docs/5.2/providers#registering-providers)

```php
'providers' => [
    ...
    FindBrok\TradeoffAnalytics\TradeoffAnalyticsServiceProvider::class,
    ...
]
```

## Configuration

Once installed you can now publish your config file and set your correct configuration for using the package.

```
php artisan vendor:publish --provider="FindBrok\TradeoffAnalytics\TradeoffAnalyticsServiceProvider" --tag="config"
```

This will create a file ```config/tradeoff-analytics.php``` , for information on how to set values present in this file see [Configuration Before Usage](https://github.com/findbrok/laravel-tradeoff-analytics/wiki/Configuration-Before-Usage)

## Usage

Read the [docs](https://github.com/findbrok/laravel-tradeoff-analytics/wiki)

## Credits

[![Percy Mamedy](https://img.shields.io/badge/Author-Percy%20Mamedy-orange.svg)](https://twitter.com/PercyMamedy)

Twitter: [@PercyMamedy](https://twitter.com/PercyMamedy)
<br/>
GitHub: [percymamedy](https://github.com/percymamedy)
