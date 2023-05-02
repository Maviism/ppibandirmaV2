<?php

namespace App\Models\UserInformation;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\User;

class PersonalInformation extends Model
{
    use HasFactory;

    protected $fillable = [
        'phone_number',
        'birthday',
        'gender',
        'address_tr',
    ];

    public function user(){
        return $this->belongsTo(User::class);
    }
}
