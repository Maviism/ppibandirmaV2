<?php

namespace App\Services;
use Illuminate\Support\Facades\Mail;

class WhatsappService
{
    protected $enabled;
    protected $apikey;
    protected $baseUrl;

    public function __construct()
    {
        $this->enabled = config('whatsapp.enabled');
        $this->apiKey = config('whatsapp.api_key');
        $this->baseUrl = config('whatsapp.url');
    }

    public function sendMessage($recipient, $is_group, $message)
    {
        if (!$this->enabled) {
            return;
        }
        $params = [
            'recipient' => $recipient,
            'is_group' => $is_group,
            'message' => $message
        ];
    
        $headers = [
            'x-api-key' => $this->apiKey
        ];
        
        
        $res = $response = $this->sendRequest('post', '/api/send-message', $params, $headers);
        if($res){
            return 1;
        }else{
            return 0;
        }
    }

    private function sendRequest($method, $url,$params = [], $headers = [])
    {
        $client = new \GuzzleHttp\Client([
            'headers' => $headers
        ]);

        try{
            $response = $client->request($method, $this->baseUrl.$url, [
                'form_params' => $params
            ]);
            return 1;
        } catch (\Exception $e) {
            // Send email notification
            $recipientEmail = 'muadzihharul@gmail.com';
            $subject = '[PPI Bandirma] WA Error sending message';
            $content = 'There was an error sending a message: ' . $e->getMessage();

            Mail::raw($content, function ($message) use ($recipientEmail, $subject) {
                $message->to($recipientEmail)
                        ->subject($subject);
            });
            return 0;
        }

    }
}
