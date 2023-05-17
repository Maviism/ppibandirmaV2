<?php

namespace App\Models\Akastrat;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Ebook extends Model
{
    use HasFactory;

    protected $fillable = [
        'folder_name',
        'folder_url'
    ];
}
