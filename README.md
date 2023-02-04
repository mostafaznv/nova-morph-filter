[![Latest Version on Packagist](https://img.shields.io/packagist/v/mostafaznv/nova-morph-filter.svg?style=flat-square)](https://packagist.org/packages/mostafaznv/nova-morph-filter)
[![Software License](https://img.shields.io/badge/license-Apache-brightgreen.svg?style=flat-square)](LICENSE.txt)
[![Total Downloads](https://img.shields.io/packagist/dt/mostafaznv/nova-morph-filter.svg?style=flat-square)](https://packagist.org/packages/mostafaznv/nova-morph-filter)

# Morph Filter for Laravel Nova

Morph filter fields for laravel nova

----
I develop in a open-source journey 🚀, I wish I lived in an environment where financial situation was fine and I could only focus on the path, but as you may know, life isn't perfect.
So if you end up using my packages, please consider making a donation, any amount would go along way and is much appreciated. 🍺

[![Donate](https://mostafaznv.github.io/donate/donate.svg)](https://mostafaznv.github.io/donate)

----

## Requirements:

- PHP 8.0 or higher
- Laravel 8.* or higher


## Installation

Install using composer:

```
composer require mostafaznv/nova-morph-filter
```


## Usage
```
use Mostafaznv\NovaMorphFilter\NovaMorphFilter;

class Post extends Resource
{
    ...
    
    public function fields(Request $request): array
    {
        return [
            ...

            MorphTo::make(trans('Owner'), 'owner')
                ->types([Admin::class, User::class])
        ];
    }


    public function filters(Request $request): array
    {
        return [
            (new NovaMorphFilter(trans('Owner'), 'owner'))
                ->types([User::class, Admin::class])
        ];
    }
}
```

----
I develop in a open-source journey 🚀, I wish I lived in an environment where financial situation was fine and I could only focus on the path, but as you may know, life isn't perfect.
So if you end up using my packages, please consider making a donation, any amount would go along way and is much appreciated. 🍺

[![Donate](https://mostafaznv.github.io/donate/donate.svg)](https://mostafaznv.github.io/donate)

----

## Changelog
Refer to the [Changelog](CHANGELOG.md) for a full history of the project.

## License
This software released under [Apache License Version 2.0](LICENSE.txt).

(C) 2022 Mostafaznv, All rights reserved.
