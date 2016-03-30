# BoasVindasBot
http://telegram.me/BoasVindas_bot

## Este repositório usa

- [Laravel 5.1](https://github.com/laravel/laravel/tree/5.1)
- [Telegram Bot SDK 2.0](https://github.com/irazasyed/telegram-bot-sdk)

## Depois de clonar este repositório
### Terminal:
```shell
php composer self-update
php composer install
cp .env.example .env
php artisan key:generate
```

### Atualize o arquivo ".env"
```
TELEGRAM_BOT_TOKEN=token
TELEGRAM_BOT_WEBHOOK=https://url/webhook
```

Abra o URL de onde você está rodando o Laravel para atualizar o webhook (lembrando que definimos isto no routes.php)

### Configure seu bot no [@BotFather](https://telegram.me/BotFather)
- /setprivacy: Disable
- /setjoingroups: Enable
