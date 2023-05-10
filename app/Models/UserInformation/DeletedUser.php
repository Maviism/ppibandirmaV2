<?php

namespace App\Models\UserInformation;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DeletedUser extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'arrival_year',
        'reason'
    ];
}
