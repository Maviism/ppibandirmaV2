<?php

namespace App\Http\Livewire;
use App\Models\Organisation\Link;

use Livewire\Component;

class Links extends Component
{
    public $links;

    public function mount()
    {
        $this->links = Link::orderBy('position')->get();
    }

    public function render()
    {
        return view('livewire.links');
    }

    public function reorder($orderIds){
        // Update the order of FAQ items based on the received orderIds
        foreach ($orderIds as $index => $orderId) {
            $link = Link::find($orderId);
            $link->position = $index + 1; // Adjust as needed based on your starting index
            $link->save();
        }

        // Re-fetch the FAQs from the database to ensure the order is updated
        $this->links = Link::orderBy('position')->get();
    }
}
