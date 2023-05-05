<?php

namespace App\Models\Organisation;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Kabinet extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'periode',
        'description',
        'logo_url'
    ];
}
