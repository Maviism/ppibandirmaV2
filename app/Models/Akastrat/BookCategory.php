<?php

namespace App\Models\Akastrat;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BookCategory extends Model
{
    use HasFactory;

    protected $fillable = [
        'book_id',
        'category_id'
    ];

    public function category(){
        return $this->belongsTo(Category::class);
    }
    
}
