# Local Avatar Images provider for Filament

[![Latest Version on Packagist](https://img.shields.io/packagist/v/bondarde/filament-local-avatar.svg?style=flat-square)](https://packagist.org/packages/bondarde/filament-local-avatar)

Creates local avatar images from user's name with e-mail fallback.
Used madel's properties, separators, avatar length, font sizes and fallback "name" are configurable.

Local avatar provider allows offline work and application deployment to sensitive and offline environments.

## Installation

You can install the package via Composer:

```bash
composer require bondarde/filament-local-avatar
```

You can publish the config file with:

```bash
php artisan vendor:publish --tag="filament-local-avatar-config"
```

Optionally, you can publish the views using

```bash
php artisan vendor:publish --tag="filament-local-avatar-views"
```

## Usage

```php
    use BondarDe\FilamentLocalAvatar\LocalAvatarProvider;

    public function panel(Panel $panel): Panel
        {
           return $panel
                ->id()
                // ...
                ->defaultAvatarProvider(LocalAvatarProvider::class)
                // ...
```

## Changelog

Please see [CHANGELOG](CHANGELOG.md) for more information on what has changed recently.

## Credits

- [Alexander Bondar](https://github.com/bondarde)
- [All Contributors](../../contributors)

## License

The MIT License (MIT). Please see [License File](LICENSE.md) for more information.
