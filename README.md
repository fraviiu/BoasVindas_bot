# [BoasVindasBot](http://telegram.me/BoasVindas_bot)
This Telegram Bot welcomes the new members of their group (in Portuguese-BR).

[Readme em Português](https://github.com/JaoNoctus/BoasVindas_bot/blob/master/README-pt_BR.md)

> Current Build Status

[![Build Status](https://travis-ci.org/JaoNoctus/BoasVindas_bot.svg?branch=master)](https://travis-ci.org/JaoNoctus/BoasVindas_bot)
[![StyleCI](https://styleci.io/repos/48139714/shield)](https://styleci.io/repos/48139714)

## Support the project
[![Support the project](host1plus.gif)](https://affiliates.host1plus.com/ref/jaonoctus/a3ee1c84.html)

## This project uses

- [Laravel 5.1](https://github.com/laravel/laravel/tree/5.1)
- [Telegram Bot SDK 2.0](https://github.com/irazasyed/telegram-bot-sdk)
- [Composer](https://getcomposer.org)

## Installation

### 1. Dependency
Run the commands in terminal

```shell
php composer self-update
php composer install
cp .env.example .env
php artisan key:generate
```

### 2. The ".env" file
```
TELEGRAM_BOT_TOKEN=token
TELEGRAM_BOT_WEBHOOK=https://url/webhook
```

### 3. [Webhook](https://core.telegram.org/bots/api#setwebhook)
After you update your `TELEGRAM_BOT_TOKEN` and the `TELEGRAM_BOT_TOKEN`, access your `https://url/`.

(We set the route `/` to set you webhook at `routes.php` file)

### 4. At [@BotFather](https://telegram.me/BotFather)
- /setprivacy: Disable
- /setjoingroups: Enable
