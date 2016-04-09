<?php

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Telegram\Bot\Api;

class TelegramTest extends TestCase
{
	protected $telegram;

	public function setUp()
	{
		$this->telegram = new Api('token');
	}

	/**
     * @test
     * @expectedException \Telegram\Bot\Exceptions\TelegramSDKException
     */
	public function it_throws_exception_when_no_token_is_provided()
	{
		new Api();
	}

	/** @test */
	public function token_ok()
	{
		new Api(env('TELEGRAM_BOT_TOKEN'));
	}
}
