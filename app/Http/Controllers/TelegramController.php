<?php namespace App\Http\Controllers;

use Illuminate\Routing\Controller as BaseController;
use Telegram\Bot\Api;

class TelegramController extends BaseController
{
    protected $telegram;
    protected $msg_self;
    protected $msg_start;
    protected $hi = ['Olá', 'Opa', 'Salve salve', 'Fala aí', 'E aí'];

    public function __construct()
    {
        $this->telegram     = new Api(env('TELEGRAM_BOT_TOKEN'));
		self::setWebhook();
        $this->msg_self     = 'Olá, eu sou o @' . self::getBotUsername() . ".\nQuando este grupo receber um novo membro, darei boas vindas a ele 😉";
        $this->msg_start    = "Vamos começar?\nPara que eu possa receber os novos membros em seu grupo, basta me adicionar lá 😄 É só clicar:\n\nhttp://telegram.me/".self::getBotUsername()."?startgroup=1";
    }

	public function setWebhook()
	{
		$this->telegram->setWebhook(['url' => env('TELEGRAM_BOT_WEBHOOK')]);
	}

    private function getBotUsername()
    {
        return $this->telegram->getMe()->getUsername();
    }

    public function postWebhook()
    {
        $this->update     = $this->telegram->getWebhookUpdates();
        $this->message    = $this->update->getMessage();
        $this->chat       = $this->message->getChat();
        $this->from       = $this->message->getNewChatParticipant();

        $this->t_chatId		= $this->chat->getId();
        $this->t_chatTitle	= $this->chat->getTitle();

		self::processMessage();
    }

	private function processMessage()
	{
		if ($this->from !== NULL) {
			$from_name 	= "{$this->from->getFirstName()} {$this->from->getLastName()}";
			$from_user 	= $this->from->getUsername();
			if ($from_user !== NULL) $from_name .= " (@{$from_user})";

			$hello = self::randomHi() . ' ' . $from_name . "\nSeja bem vindo(a) ao grupo ''{$this->t_chatTitle}''!";

			$this->t_Text = ($from_user == self::getBotUsername()) ? $this->msg_self : $hello;
		}

		if (strpos($this->message->getText(), "/start") === 0 AND $this->t_chatTitle == NULL) {
			$this->t_Text = $this->msg_start;
		}

		if (isset($this->t_Text)) {
			self::sendMessage();
		}
	}

	private function sendMessage()
	{
		self::sendActionTyping();

		$this->telegram->sendMessage([
			'chat_id' 					=> $this->t_chatId,
			'text'						=> $this->t_Text,
			'disable_web_page_preview'	=> TRUE
		]);
	}

    private function randomHi()
    {
        $key = array_rand($this->hi, 2);
        return $this->hi[$key[0]];
    }

    private function sendActionTyping()
    {
        $this->telegram->sendChatAction([
            'chat_id'   => $this->t_chatId,
            'action'    => 'typing'
        ]);
    }
}
