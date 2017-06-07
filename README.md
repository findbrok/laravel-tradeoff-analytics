<p align="center">
	<img src="https://raw.githubusercontent.com/findbrok/art-work/master/packages/laravel-tradeoff-analytics/laravel-tradeoff-analytics.png">
</p>

<h2 align="center">
   Laravel 5 Tradeoff Analytics 
</h2>

<p align="center">
    <a href="https://packagist.org/packages/findbrok/laravel-tradeoff-analytics"><img src="https://poser.pugx.org/findbrok/laravel-tradeoff-analytics/v/stable" alt="Latest Stable Version"></a>
    <a href="https://packagist.org/packages/findbrok/laravel-tradeoff-analytics"><img src="https://poser.pugx.org/findbrok/laravel-tradeoff-analytics/v/unstable" alt="Latest Unstable Version"></a>
    <a href="https://travis-ci.org/findbrok/laravel-tradeoff-analytics"><img src="https://travis-ci.org/findbrok/laravel-tradeoff-analytics.svg?branch=master" alt="Build Status"></a>
    <a href="https://styleci.io/repos/59981815"><img src="https://styleci.io/repos/59981815/shield?style=flat" alt="StyleCI"></a>
    <a href="https://packagist.org/packages/findbrok/laravel-tradeoff-analytics"><img src="https://poser.pugx.org/findbrok/laravel-tradeoff-analytics/license" alt="License"></a>
    <a href="https://packagist.org/packages/findbrok/laravel-tradeoff-analytics"><img src="https://poser.pugx.org/findbrok/laravel-tradeoff-analytics/downloads" alt="Total Downloads"></a>
    <a href="https://insight.sensiolabs.com/projects/f61e9357-250f-4816-b6c0-ae1ec0bcaa42" alt="medal"><img src="https://insight.sensiolabs.com/projects/f61e9357-250f-4816-b6c0-ae1ec0bcaa42/mini.png"></a>
</p>

## Introduction
Laravel 5 Tradeoff Analytics is a simple Laravel 5 wrapper around 
[IBM Watson Tradeoff Analytics API](http://www.ibm.com/smarterplanet/us/en/ibmwatson/developercloud/tradeoff-analytics.html)

## License
Laravel 5 Tradeoff Analytics is open-sourced software licensed under the [MIT license](http://opensource.org/licenses/MIT).

### How it works
Tradeoff Analytics is a Watson service that helps people make decisions when balancing multiple objectives. 
The service uses a mathematical filtering technique called “Pareto Optimization,” that enables users 
to explore tradeoffs when considering multiple criteria for a single decision.

### Intended Use
Tradeoff Analytics can help bank analysts or wealth managers select the best investment strategy 
based on performance attributes, risk, and cost. It can help consumers purchase the product 
that best matches their preferences based on attributes like features, price, or 
warranties. Additionally, Tradeoff Analytics can help physicians find the 
most suitable treatment based on multiple criteria such as success 
rate, effectiveness, or adverse effects.

### Installation
Install the package through composer

```bash
$ composer require findbrok/laravel-tradeoff-analytics
```

Depending on your Laravel version you will install one of the following
versions of Tradeoff Analytics.

 Laravel        | Tradeoff Analytics
:---------------|:------------------
 5.0.x - 5.3.x  | 0.1.x
 5.4.x - 5.5.x  | 0.2.x

> If you are using Laravel >= 5.5, you can skip service registration 
> and aliases registration thanks to Laravel auto package discovery 
> feature.

Add the ```WatsonBridgeServiceProvider``` and ```TradeoffAnalyticsServiceProvider``` to your providers array 
in ```config/app.php```, see [Registering Providers](https://laravel.com/docs/master/providers#registering-providers):

```php
'providers' => [
    // Other Service Providers...
    FindBrok\WatsonBridge\WatsonBridgeServiceProvider::class,
    FindBrok\TradeoffAnalytics\TradeoffAnalyticsServiceProvider::class,
]
```

You can also add the following alias to you app.php file:

```php
'aliases' => [
    ...
    'TradeoffAnalytics' => FindBrok\TradeoffAnalytics\Facades\TradeoffAnalytics::class,
]
```

### Configuration
Once installed you can now publish your config file and set your correct configuration for using the package:

```bash
$ php artisan vendor:publish --tag="watson-api-bridge"
```
```bash
$ php artisan vendor:publish --tag="watson-tradeoff-analytics"
```

This will create the files ```config/watson-bridge.php``` and ```config/tradeoff-analytics.php``` respectively.

### Usage
Read the [docs](https://github.com/findbrok/laravel-tradeoff-analytics/wiki)

### Credits
Big Thanks to all developers who worked hard to create something amazing!
 
### Creator
[![Percy Mamedy](https://img.shields.io/badge/Author-Percy%20Mamedy-orange.svg)](https://twitter.com/PercyMamedy)

Twitter: [@PercyMamedy](https://twitter.com/PercyMamedy)
<br/>
GitHub: [percymamedy](https://github.com/percymamedy)
