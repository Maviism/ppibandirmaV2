<?php

namespace App\Services;

class WhatsappService
{
    protected $enabled;
    protected $apikey;
    protected $url;

    public function __construct()
    {
        $this->enabled = config('whatsapp.enabled');
        $this->apiKey = config('whatsapp.api_key');
        $this->url = config('whatsapp.url');
    }

    public function sendMessage($number, $message)
    {
        if (!$this->enabled) {
            return;
        }
        dd('hello');
        // Logika pengiriman pesan WhatsApp menggunakan API atau library pihak ketiga
        // ...
    }
}
