# BoasVindasBot
http://telegram.me/BoasVindas_bot

## Este repositório usa

- [Laravel 5.1](https://github.com/laravel/laravel/tree/5.1)
- [Telegram Bot SDK 2.0](https://github.com/irazasyed/telegram-bot-sdk)

## Depois de clonar este repositório
Terminal:
```bash
php composer update
```

Atualize o arquivo ".env"
```
TELEGRAM_BOT_TOKEN=<token>
TELEGRAM_BOT_WEBHOOK=https://<url>/webhook
```

Atualize o arquivo "app/Http/Controllers/TelegramController.php"
```php
$this->telegram->setWebhook(['url' => 'https://setyourwebhook']);
```
