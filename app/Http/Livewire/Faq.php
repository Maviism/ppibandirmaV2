<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\Advokasi\FrequentlyAskQuestion;

class Faq extends Component
{
    public $faqs;

    public function mount()
    {
        $this->faqs = FrequentlyAskQuestion::orderBy('sequence')->get();
    }

    public function render()
    {
        return view('livewire.faq');
    }

    public function reorder($orderIds){
        // Update the order of FAQ items based on the received orderIds
        foreach ($orderIds as $index => $orderId) {
            $faq = FrequentlyAskQuestion::find($orderId);
            $faq->sequence = $index + 1; // Adjust as needed based on your starting index
            $faq->save();
        }

        // Re-fetch the FAQs from the database to ensure the order is updated
        $this->faqs = FrequentlyAskQuestion::orderBy('sequence')->get();
    }

}
