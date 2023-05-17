<?php

namespace App\Models\Akastrat;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Book extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'author',
        'number_of_pages',
        'publisher',
        'synopsis',
        'thumbnail_url'
    ];

    public function bookCategory(){
        return $this->hasMany(BookCategory::class);
    }
}
