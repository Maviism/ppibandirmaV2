<?php

namespace App\Models\Event;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Event\Absensi;

class Event extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'venue',
        'datetime',
        'type',
        'description',
        'image_url',
        'total_participants'
    ];

    public function absensi()
    {
        return $this->hasMany(Absensi::class);
    }
}
