# Dusk Testing For VILT

Laravel Dusk unit test with GUI for VILT Stack

## Install

```bash
composer require 3x1io/dusk-module
```
Add Module to `modules_statuses.json` if not exists

```json
{
    "Dusk": true
}
```

```bash
php artisan dusk:install
```

```bash
php artisan config:clear
```

```bash
php artisan migrate
```

```bash
php artisan roles:generate test_logs
```

Publish Assets

```bash
yarn
```

```bash
yarn build
```



## Support

you can join our discord server to get support [VILT Admin](https://discord.gg/HUNYbgKDdx)

## Changelog

Please see [CHANGELOG](CHANGELOG.md) for more information on what has changed recently.

## Credits

- [Fady Mondy](https://github.com/3x1io)

## License

The MIT License (MIT). Please see [License File](LICENSE.md) for more information.

