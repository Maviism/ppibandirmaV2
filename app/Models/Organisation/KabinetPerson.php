<?php

namespace App\Models\Organisation;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class KabinetPerson extends Model
{
    use HasFactory;

    protected $fillable = [
        'kabinet_id',
        'name',
        'description',
        'instagram',
        'profile_pict_url'
    ];
}
