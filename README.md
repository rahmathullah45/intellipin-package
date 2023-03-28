# Intellipin Laravel Package


## This will generate a random pin in effective way with some restrictions.

## Installation

In order install this package, Just run the following command and it will auto discover the package resources.
```shell
composer require rahmat/intellipin
```

## Configuration

```bash
php artisan migrate
```

After the migration, the below new table will be present:
- `pins` &mdash; stores utilised pins.

## Usage

```php
RandomPin::generate();

RandomPin::generate(6); //with length
```

## License

Intellipin is free software distributed under the terms of the MIT license.