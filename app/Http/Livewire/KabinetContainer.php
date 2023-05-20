<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\Organisation\Kabinet;

class KabinetContainer extends Component
{
    public $periode;

    public function mount()
    {
        $this->validate([
            'periode' => ['required', 'max:20', 'string'] // Add your desired validation rules here
        ]);
        $this->periode = request('periode');
    }

    public function render()
    {
        $kabinet = Kabinet::where('periode', $this->periode)->first();
        if(empty($kabinet)){
            abort(404);
        }
        return view('livewire.kabinet-container', ['kabinet' => $kabinet]);
    }

}
