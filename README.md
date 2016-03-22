# BoasVindasBot
http://telegram.me/BoasVindas_bot

## Este repositório usa

- [Laravel 5.1](https://github.com/laravel/laravel/tree/5.1)
- [Telegram Bot SDK 2.0](https://github.com/irazasyed/telegram-bot-sdk)

## Depois de clonar este repositório
Terminal:
```bash
php composer self-update; php composer update
```

Atualize o arquivo ".env"
```
TELEGRAM_BOT_TOKEN=<token>
TELEGRAM_BOT_WEBHOOK=https://<url>/webhook
```

Abra o URL de onde você está rodando o Laravel para atualizar o webhook (lembrando que definimos isto no routes.php)
