<?php

namespace App\Models\Organisation;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Organisation\kabinetPerson;

class Kabinet extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'periode',
        'description',
        'logo_url'
    ];

    public function kabinetPerson(){
        return $this->hasMany(kabinetPerson::class);
    }
}
