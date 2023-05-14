<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\Organisation\Kabinet;

class KabinetContainer extends Component
{
    public function render()
    {
        $kabinet = Kabinet::first();
        return view('livewire.kabinet-container', ['kabinet' => $kabinet]);
    }

}
