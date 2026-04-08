<div align="center">

<img src="https://www.screenscraper.fr/images/logo-512x512.png" width="100" alt="ScreenScraper">

# `gboquizosanchez/screenscraper`

**ScreenScraper.fr API client for Laravel**

[![Latest Stable Version](https://img.shields.io/packagist/v/gboquizosanchez/screenscraper.svg)](https://packagist.org/packages/gboquizosanchez/screenscraper)
[![Total Downloads](https://img.shields.io/packagist/dt/gboquizosanchez/screenscraper.svg)](https://packagist.org/packages/gboquizosanchez/screenscraper)
[![PHP](https://img.shields.io/badge/PHP-%5E8.3-777BB4?logo=php&logoColor=white)](https://packagist.org/packages/gboquizosanchez/screenscraper)
[![Laravel](https://img.shields.io/badge/Laravel-11%20%7C%2012-FF2D20?logo=laravel&logoColor=white)](https://packagist.org/packages/gboquizosanchez/screenscraper)
[![License: MIT](https://img.shields.io/badge/License-MIT-22C55E.svg)](LICENSE.md)

---

*Fetch game metadata, media, and platform data from ScreenScraper.fr directly in your Laravel app.*

</div>

---

## Overview

A Laravel package that wraps the full [ScreenScraper API](https://www.screenscraper.fr/webapi2.php?alpha=0&numpage=0), giving you access to game info, artwork, ratings, and more — with optional DTO mapping via [spatie/laravel-data](https://github.com/spatie/laravel-data).

> **Note:** You need a ScreenScraper account and developer credentials to use this package. Register [here](https://www.screenscraper.fr/membreinscription.php) and request developer access [here](https://www.screenscraper.fr/forumsujets.php?frub=12&numpage=0).

---

## 📦 Installation

```bash
composer require gboquizosanchez/screenscraper
```

Add your credentials to `.env`:

```env
SCREENSCRAPER_BASE_URL=https://api.screenscraper.fr/api2/
SCREENSCRAPER_OUTPUT=json
SCREENSCRAPER_USERNAME=your_username
SCREENSCRAPER_PASSWORD=your_password
SCREENSCRAPER_DEV_ID=your_dev_id
SCREENSCRAPER_DEV_PASSWORD=your_dev_password
SCREENSCRAPER_SOFTNAME="ScreenScraper API Client for Laravel"
SCREENSCRAPER_DTO_MAPPING=true
SCREENSCRAPER_RAW_MAPPING=false
```

Optionally, publish the configuration file:

```bash
php artisan vendor:publish --provider="ScreenScraper\ScreenScraperServiceProvider"
```

---

## 🚀 Usage

### Via facade

The facade reads credentials directly from your `.env`:

```php
use ScreenScraper\ScreenScraperClient;

ScreenScraperClient::getGame(gameId: 1);
```

### Via the client directly

Useful when working with multiple accounts or custom credentials:

```php
use ScreenScraper\Data\AuthData;
use ScreenScraper\Models\ScreenScraper;

$auth = new AuthData(
    devId: 'your_dev_id',
    devPassword: 'your_dev_password',
    softname: 'Your App Name',
    output: 'json',
    ssid: 'your_username',
    sspassword: 'your_password',
);

$client = new ScreenScraper($auth);
$client->getGame(gameId: 1);
```

You can also use the default credentials from config:

```php
$auth = new AuthData(...config('screenscraper.credentials'));
```

---

## 🗺️ Response mapping

By default, the package maps responses to typed DTOs. You can switch to raw responses via `.env`:

```env
# Default — typed DTOs via spatie/laravel-data
SCREENSCRAPER_DTO_MAPPING=true
SCREENSCRAPER_RAW_MAPPING=false

# Raw responses — disable DTO mapping first
SCREENSCRAPER_DTO_MAPPING=false
SCREENSCRAPER_RAW_MAPPING=true
```

> `RAW` mapping only works when `SCREENSCRAPER_DTO_MAPPING` is set to `false`.

---

## 📚 Available methods

This package covers all endpoints from the [ScreenScraper API](https://www.screenscraper.fr/webapi2.php?alpha=0&numpage=0). See [`ScreenScraperClient`](src/ScreenScraperClient.php) for the full method list.

---

## 🧪 Testing

```bash
composer test
```

---

## Contributing

Contributions are welcome!

- 🐛 **Report bugs** via [GitHub Issues](https://github.com/gboquizosanchez/screenscraper/issues/new)
- 💡 **Suggest features** or improvements
- 🔧 **Submit pull requests** with fixes or enhancements

---

## Credits

- **Author**: [Germán Boquizo Sánchez](mailto:germanboquizosanchez@gmail.com)
- **Contributors**: [View all contributors](../../contributors)

---

## 📄 License

This package is open-source software licensed under the [MIT License](LICENSE.md).
