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
        $this->msg_self     = 'Olá, eu sou o @' . self::getBotUsername() . ".\nQuando este grupo receber um novo membro, darei boas vindas a ele 😉";
        $this->msg_start    = "Vamos começar?\nPara que eu possa receber os novos membros em seu grupo, basta me adicionar lá 😄 É só clicar:\n\nhttp://telegram.me/".self::getBotUsername()."?startgroup=1";
        //$this->telegram->setWebhook(['url' => 'https://setyourwebhook']);
    }

    private function getBotUsername()
    {
        return $this->telegram->getMe()->getUsername();
    }

    public function postWebhook()
    {
        $update     = $this->telegram->getWebhookUpdates();
        $message    = $update->getMessage();
        $chat       = $message->getChat();
        $from       = $message->getNewChatParticipant();

        $data['chat_id']    = $chat->getId();
        $data['group']      = $chat->getTitle();

        if ($from !== NULL) {
            $from_name      = "{$from->getFirstName()} {$from->getLastName()}";
            $from_user      = $from->getUsername();
            $data['name']   = ($from_user !== NULL) ? "{$from_name} (@{$from_user})" : $from_name;

            if ($from_user == self::getBotUsername()) {
                $this->telegram->sendMessage([
                    'chat_id'       => $data['chat_id'],
                    'text'          => $this->msg_self
                ]);
            } else {
                self::sendHello($data);
            }
        }

        if (strpos($message->getText(), "/start") === 0 AND $chat->getTitle() == NULL) {
            $this->telegram->sendMessage([
                'chat_id'                   => $data['chat_id'],
                'disable_web_page_preview'  => true,
                'text'                      => $this->msg_start
            ]);
        }
    }

    private function randomHi()
    {
        $key = array_rand($this->hi, 2);
        return $this->hi[$key[0]];
    }

    private function sendHello($data)
    {
        self::sendActionTyping($data['chat_id']);

        $this->telegram->sendMessage([
            'chat_id'   => $data['chat_id'],
            'text'      => self::randomHi() . ' ' . $data['name'] . "\nSeja bem vindo(a) ao grupo \"{$data['group']}\"!"
        ]);
    }

    private function sendActionTyping($chat_id)
    {
        $this->telegram->sendChatAction([
            'chat_id'   => $chat_id,
            'action'    => 'typing'
        ]);
    }
}
