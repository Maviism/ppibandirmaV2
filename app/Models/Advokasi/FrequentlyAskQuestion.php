<?php

namespace App\Models\Advokasi;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FrequentlyAskQuestion extends Model
{
    use HasFactory;

    protected $fillable = [
        'category',
        'question',
        'answer',
        'sequence'
    ];
}
