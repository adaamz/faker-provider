# faker-provider

[![Build Status](https://travis-ci.com/localheinz/faker-provider.svg?branch=master)](https://travis-ci.com/localheinz/faker-provider)
[![codecov](https://codecov.io/gh/localheinz/faker-provider/branch/master/graph/badge.svg)](https://codecov.io/gh/localheinz/faker-provider)
[![Latest Stable Version](https://poser.pugx.org/localheinz/faker-provider/v/stable)](https://packagist.org/packages/localheinz/faker-provider)
[![Total Downloads](https://poser.pugx.org/localheinz/faker-provider/downloads)](https://packagist.org/packages/localheinz/faker-provider)

Provides additional providers for [`fzaninotto/faker`](https://github.com/fzaninotto/Faker).

## Installation

Run

```
$ composer require --dev localheinz/faker-provider
```

## Usage

Once you have created an instance of `Faker\Generator`, providers can be added like this:

```php
use Faker\Factory;
use Localheinz\Faker\Provider;

$faker = Factory::create();

$faker->addProvider(new Provider\AvatarUrlProvider($faker));
```

## Providers

This package provides the following providers for use with [`fzaninotto/faker`](https://github.com/fzaninotto/Faker):

* [`Localheinz\Faker\Provider\AvatarUrlProvider`](https://github.com/localheinz/faker-provider#avatarurlprovider)

### `AvatarUrlProvider`

```php
use Faker\Generator;
use Localheinz\Faker\Provider;

$userName = $faker->userName;
$size = $faker->numberBetween(100, 450);

/** @var Generator&Provider\AvatarUrlProvider $faker */
$avatarUrl = $faker->adorableAvatarUrl(
    $userName,
    $size
);
```

![Example of ](https://api.adorable.io/avatars/150/localheinz.png)

Also see [avatars.adorable.io](http://avatars.adorable.io/).

## Changelog

Please have a look at [`CHANGELOG.md`](CHANGELOG.md).

## Contributing

Please have a look at [`CONTRIBUTING.md`](.github/CONTRIBUTING.md).

## Code of Conduct

Please have a look at [`CODE_OF_CONDUCT.md`](.github/CODE_OF_CONDUCT.md).

## License

This package is licensed using the MIT License.
