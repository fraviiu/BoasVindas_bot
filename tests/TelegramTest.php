<?php

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Telegram\Bot\Api;
use Telegram\Bot\Objects\Message;

class TelegramTest extends TestCase
{
	protected $telegram;

	public function setUp()
	{
		$this->telegram = new Api('token');
	}

	/** @test */
	public function sendMessage()
	{
		$this->telegram = new Api(env('TELEGRAM_BOT_TOKEN', ''));

		$var = [
			'chat_id'	=> env('TELEGRAM_CHAT_ID', ''),
			'text'		=> 'OK'
		];

		$response = $this->telegram->sendMessage(['chat_id' => $var['chat_id'], 'text' => $var['text']]);

		$this->assertInstanceOf(Message::class, $response);
		$this->assertEquals($var['chat_id'], $response->getChat()->getId());
		$this->assertEquals($var['text'], $response->getText());
	}
}
