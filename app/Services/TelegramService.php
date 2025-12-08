<?php

namespace App\Services;

class TelegramService
{
    protected $token;
    protected $apiUrl;

    public function __construct()
    {
        // Ambil token dari config yang benar
        $this->token = env('TELEGRAM_BOT_TOKEN');

        // Buat base URL lengkap
        $this->apiUrl = "https://api.telegram.org/bot{$this->token}/";
    }

    // -------------------------
    // SEND TEXT MESSAGE
    // -------------------------
    public function sendMessage($chatId, $text)
    {
        return $this->post("sendMessage", [
            "chat_id" => $chatId,
            "text" => $text,
            "parse_mode" => "Markdown"
        ]);
    }

    // -------------------------
    // SEND PHOTO WITH CAPTION
    // -------------------------
    public function sendPhoto($chatId, $fileId, $caption)
    {
        return $this->post("sendPhoto", [
            "chat_id" => $chatId,
            "photo" => $fileId,
            "caption" => $caption,
            "parse_mode" => "Markdown"
        ]);
    }

    // -------------------------
    // SEND MESSAGE WITH BUTTONS
    // -------------------------
    // public function sendButtons($chatId, $text, $buttons)
    // {
    //     return $this->post("sendMessage", [
    //         "chat_id" => $chatId,
    //         "text" => $text,
    //         "parse_mode" => "Markdown",
    //         "reply_markup" => json_encode([
    //             "inline_keyboard" => $buttons
    //         ])
    //     ]);
    // }
    public function sendButtons($chatId, $text, $buttons)
    {
        return $this->post("sendMessage", [
            "chat_id" => $chatId,
            "text" => $text,
            "parse_mode" => "Markdown",
            "reply_markup" => json_encode([
                "inline_keyboard" => $buttons
            ])
        ]);
    }

    // -------------------------
    // GENERIC POST TO TELEGRAM
    // -------------------------
    private function post($method, $payload)
    {
        $url = $this->apiUrl . $method;

        $context = stream_context_create([
            "http" => [
                "header" => "Content-Type: application/json\r\n",
                "method" => "POST",
                "content" => json_encode($payload)
            ]
        ]);

        return file_get_contents($url, false, $context);
    }

    // -------------------------
    // ANSWER CALLBACK BUTTON
    // -------------------------
    public function answerCallback($callbackId)
    {
        return $this->post("answerCallbackQuery", [
            "callback_query_id" => $callbackId
        ]);
    }
}
