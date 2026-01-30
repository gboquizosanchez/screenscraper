<p align="center" dir="auto"><a href="https://screenscraper.org" rel="nofollow"><img src="https://www.screenscraper.fr/images/logo-512x512.png" width="100" alt="ScreenScraper Logo" style="max-width: 100%;"></a></p>
<h1 align="center">ScreenScraper.org API Container for Laravel</h1>

<hr />

## Summary
A library that lets you get data from ScreenScraper directly in your Laravel application.

## Starting 🚀

### Prerequisites 📋
- Composer.
- PHP version 8.3 or higher.

## Running 🛠️

Install the package via composer:

```shell
composer require gboquizosanchez/screenscraper
```

Establish the configuration in the `.env` file:

```dotenv
SCREENSCRAPER_BASE_URL=https://api.screenscraper.fr/api2/
SCREENSCRAPER_OUTPUT=json
SCREENSCRAPER_USERNAME=your_username
SCREENSCRAPER_PASSWORD=your_password
SCREENSCRAPER_DTO_MAPPING=true
SCREENSCRAPER_RAW_PROPERTIES=false
SCREENSCRAPER_DEV_ID=xxx
SCREENSCRAPER_DEV_PASSWORD=yyy
SCREENSCRAPER_SOFTNAME="ScreenScraper API Client for Laravel"

```

You can also publish the configuration file to customize the package:

```shell
php artisan vendor:publish --provider="ScreenScraper\ScreenScraperServiceProvider"
```
**Note**: You need to have a ScreenScraper account to use the API. If you don't have one, you can request one [here](https://www.screenscraper.fr/forumsujets.php?frub=12&numpage=0). And also, you need to have an account. You can get one on the [register page]([https://www.screenscraper.fr/membreinscription.php).

## Basic Usage 👷

You can use two different methods:

### Using the facade

This method provides directly from ```.env``` file the username and the web API key.

```php
use ScreenScraper\ScreenScraperClient;

ScreenScraperClient::getGame(gameId: 1);
```

### Using the ScreenScraper model directly

You can provide a custom username and password if you want to use different credentials.

Or, you can use the default ones from the ```.env``` using  ```config('screenscraper.credentials')```.

```php
use ScreenScraper\Data\AuthData;
use ScreenScraper\Models\ScreenScraper;

$auth = new AuthData(
    devId: developer_identifier,
    devPassword: developer_password,
    softname: software_name,
    output: json or xml,
    ssid: user_identifier,
    sspassword: user_password,
);

$client = new ScreenScraper($auth);

$client->getGame(gameId: 1);
```

### Mapping the response 🗺️

There are two ways to map the response. By default, the package uses the DTO mapping.

```dotenv
SCREENSCRAPER_DTO_MAPPING=true
SCREENSCRAPER_MAPPING=false
```

**Note**: If you want to use the raw mapping, you need to set the ```SCREENSCRAPER_DTO_MAPPING``` to ```false``` and the ```SCREENSCRAPER_RAW_MAPPING``` to ```true```. RAW only works with DTO mapping disabled.


## Available methods 📚

This package provides all methods available in the [ScreenScraper API](https://www.screenscraper.fr/webapi2.php?alpha=0&numpage=0).

See the [ScreenScraperClient facade](src/ScreenScraperClient.php) for more information.

## Working with ⚙️
### PHP dependencies 📦
- Spatie Laravel Data [![Latest Stable Version](https://img.shields.io/badge/stable-4.18.0-blue)](https://packagist.org/packages/spatie/laravel-data)
#### Develop dependencies 🔧
- Friendsofphp Php Cs Fixer [![Latest Stable Version](https://img.shields.io/badge/stable-v3.92.5-blue)](https://packagist.org/packages/friendsofphp/php-cs-fixer)
- Hermes Dependencies [![Latest Stable Version](https://img.shields.io/badge/stable-1.2.0-blue)](https://packagist.org/packages/hermes/dependencies)
- Larastan Larastan [![Latest Stable Version](https://img.shields.io/badge/stable-v2.11.2-blue)](https://packagist.org/packages/larastan/larastan)
- Orchestra Testbench [![Latest Stable Version](https://img.shields.io/badge/stable-v9.16.0-blue)](https://packagist.org/packages/orchestra/testbench)
- Pestphp Pest [![Latest Stable Version](https://img.shields.io/badge/stable-v3.8.4-blue)](https://packagist.org/packages/pestphp/pest)

## Testing ✅

```shell
composer test
```

## Problems? 🚨

Let me know about yours by [opening an issue](https://github.com/gboquizosanchez/screenscraper/issues/new)!

## Credits 🧑‍💻

- [Germán Boquizo Sánchez](mailto:germanboquizosanchez@gmail.com)
- [All Contributors](../../contributors)

## License 📄

MIT License (MIT). See [License File](LICENSE.md).
