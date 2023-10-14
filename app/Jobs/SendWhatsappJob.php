<?php

namespace App\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use App\Services\WhatsappService;


class SendWhatsappJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;
    protected $whatsappService;
    public $number, $isGroup, $message;

    /**
     * Create a new job instance.
     */
    public function __construct(WhatsappService $whatsappService, $number, $isGroup, $message,)
    {
        $this->number = $number;
        $this->isGroup = $isGroup;
        $this->message = $message;
        $this->whatsappService = $whatsappService;
    }

    /**
     * Execute the job.
     */
    public function handle(): void
    {
        $this->whatsappService->sendMessage($this->number, $this->isGroup, $this->message);
    }
}
