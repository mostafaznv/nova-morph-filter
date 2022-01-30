# Morph Filter for Laravel Nova

Morph filter fields for laravel nova


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

## Changelog
Refer to the [Changelog](CHANGELOG.md) for a full history of the project.

## License
This software released under [Apache License Version 2.0](LICENSE.txt).

(C) 2021 Mostafaznv, All rights reserved.
