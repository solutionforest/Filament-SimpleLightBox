# Filament SimpleLightbox

[![Latest Version on Packagist](https://img.shields.io/packagist/v/solutionforest/filament-simplelightbox.svg?style=flat-square)](https://packagist.org/packages/solutionforest/filament-simplelightbox)
[![GitHub Tests Action Status](https://img.shields.io/github/actions/workflow/status/solutionforest/filament-simplelightbox/run-tests.yml?branch=main&label=tests&style=flat-square)](https://github.com/solutionforest/filament-simplelightbox/actions?query=workflow%3Arun-tests+branch%3Amain)
[![GitHub Code Style Action Status](https://img.shields.io/github/actions/workflow/status/solutionforest/filament-simplelightbox/fix-php-code-style-issues.yml?branch=main&label=code%20style&style=flat-square)](https://github.com/solutionforest/filament-simplelightbox/actions?query=workflow%3A"Fix+PHP+code+style+issues"+branch%3Amain)
[![Total Downloads](https://img.shields.io/packagist/dt/solutionforest/filament-simplelightbox.svg?style=flat-square)](https://packagist.org/packages/solutionforest/filament-simplelightbox)


## Description 

Filament SimpleLightbox is a PHP package that provides a simple and lightweight solution for implementing a lightbox feature in your Filament admin panel. It allows you to easily preview Image, PDF and Office documents within your Filament.

## Features
- Integration with the [fslightbox](https://github.com/banthagroup/fslightbox "fslightbox")  JavaScript library for the lightbox functionality.
- Supports previewing PDF and Office documents. [information](https://gist.github.com/theel0ja/b9e44a961f892ccf43e217ab74b9417b "information")
- Easy installation and usage.

## Installation

You can install the package via composer:

```bash
composer require solutionforest/filament-simplelightbox
```

## Usage

```php
Tables\Columns\ImageColumn::make('image')
                    ->simpleLightbox()
```

```php
Tables\Columns\TextColumn::make('pdf_url')
                    ->simpleLightbox("Your Url address"),
```

## Preview



https://github.com/solutionforest/Filament-SimpleLightBox/assets/68211972/8bd7b59f-d18b-4f58-911f-822f10cb879b

![image_preview](https://github.com/solutionforest/Filament-SimpleLightBox/assets/68211972/5360c521-1dba-4dd5-88df-cffae21f5b62)
![url_preview](https://github.com/solutionforest/Filament-SimpleLightBox/assets/68211972/698cc9f0-11ce-4106-832b-f58ce83a36e3)
![docx_preview](https://github.com/solutionforest/Filament-SimpleLightBox/assets/68211972/7891ad1e-a601-47b5-ac0f-ba0ba7b85554)
![pptx_preview](https://github.com/solutionforest/Filament-SimpleLightBox/assets/68211972/64cf6bae-d349-4e02-a6e1-a646abd5d508)


## Testing

```bash
composer test
```

## Changelog

Please see [CHANGELOG](CHANGELOG.md) for more information on what has changed recently.

## Contributing

Please see [CONTRIBUTING](.github/CONTRIBUTING.md) for details.

## Security Vulnerabilities

Please review [our security policy](../../security/policy) on how to report security vulnerabilities.

## Credits

- [alan](https://github.com/solutionforest)
- [All Contributors](../../contributors)

## License

The MIT License (MIT). Please see [License File](LICENSE.md) for more information.
