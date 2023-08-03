<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\User;
use Illuminate\Support\Facades\DB;

class MemberInformation extends Component
{
    public function render()
    {
        $members = User::getActiveMembers()->count();
        $graduates = User::getGraduated()->count();
        $educations = DB::table('education')
                            ->select('type_of_education', DB::raw('COUNT(*) as count'))
                            ->whereNotIn('status', ['lulus']) 
                            ->groupBy('type_of_education')
                            ->get();
        return view('livewire.member-information', [
            'members' => $members ?: 0,
            'graduates'=> $graduates ?: 0,
            'educations' => $educations->toArray() ?: 0 
        ]);
    }
}
