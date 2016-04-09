<?php

use Telegram\Bot\Api;

class TelegramTest extends TestCase
{
    protected $telegram;

    public function setUp()
    {
        $this->telegram = new Api('token');
    }

    /** @test */
    public function token_ok()
    {
        new Api(env('TELEGRAM_BOT_TOKEN'));
    }
}
