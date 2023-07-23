<?php

namespace App\Models\Akastrat;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DailyVocabulary extends Model
{
    use HasFactory;

    protected $fillable = [
        'word_id',
        'word_tr',
        'type',
        'is_posted'
    ];
}
