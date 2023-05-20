<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\Akastrat\Book;

class PojokBaca extends Component
{
    public function render()
    {
        $books = Book::with('bookCategory')->get();
        return view('livewire.pojok-baca', [
            'books' => $books
        ]);
    }
}
