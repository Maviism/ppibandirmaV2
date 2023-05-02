<?php

namespace App\Models\UserInformation;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Education extends Model
{
    use HasFactory;

    protected $fillable = [
        'arrival_year',
        'type_of_education',
        'university',
        'faculty',
        'department',
        'status'
    ];
}
