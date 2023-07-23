<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Http\Controllers\DailyVocabularyController;
use App\Services\WhatsappService;
use App\Models\Akastrat\DailyVocabulary;


class SendVocabulary extends Command
{

    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'akastrat:send-vocabulary';
    
    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Mengirimkan vocabulary ke grup whatsapp';
    
    /**
     * Execute the console command.
     */
    protected $whatsappService;

    public function __construct(WhatsappService $whatsappService)
    {
        parent::__construct();
        $this->whatsappService = $whatsappService;
    }
    
    public function handle()
    {
        $vocabs = DailyVocabulary::where('is_posted', 0)->get();
        $nouns = $vocabs->where('type', 'noun')->take(3);
        $verbs = $vocabs->where('type', 'verb')->take(3);
        $expression = $vocabs->where('type', 'expression')->first();

        if ($expression && $nouns->count() >= 3 && $verbs->count() >= 3) {
            $message = "*Günlük Kelimeleri*\n\n";
            foreach($verbs as $verb){
                $message .= "{$verb->word_tr} = {$verb->word_id}\n";
            }
            $message .= "\n";
            foreach($nouns as $noun){
                $message .= "{$noun->word_tr} = {$noun->word_id}\n";
            }
            $message .= "\n";
            $message .= "{$expression->word_tr} = {$expression->word_id}";
        } else {
            $this->whatsappService->sendMessage('905526836126', "false", "Not enough VOCABULARY data available to send the message");
            echo 'Failed send message not enough vocabulary data';
            return 0;
        }

        $messageSent = $this->whatsappService->sendMessage('*TURSU (Türkçe Kursu)*📝', "true", $message);
        // Mark verbs, nouns, and expression as posted
        if($messageSent){
            $verbIds = $verbs->pluck('id')->toArray();
            $nounIds = $nouns->pluck('id')->toArray();
            $expressionId = $expression ? $expression->id : null;
            
            $vocabIdsToMarkAsPosted = array_merge($verbIds, $nounIds, [$expressionId]);
            DailyVocabulary::whereIn('id', $vocabIdsToMarkAsPosted)->update(['is_posted' => 1]);
            echo 'Message sent';
            return 0;
        }
        
        echo 'Failed send message';
        return 0;
    }
}
