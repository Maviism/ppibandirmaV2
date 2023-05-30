<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use App\Http\Controllers\UserController;

class Whatsapp extends Controller
{
    
    public function checkNumber($phoneNumber)
    {
        $user = User::whereHas('personalInformation', function ($query) use ($phoneNumber) {
            $query->where('phone_number', $phoneNumber);
        })->first();
    
        return $user ? $user->id : false;
    }
    
    public function memberCard($number)
    {
        $user_id = $this->checkNumber($number);
    
        if (!$user_id) {
            return response()->json([
                'message' => 'Your phone number has not been registered. Please change your phone number on PPI Bandirma\'s website.'
            ], 404);
        }
    
        $encryptedId = User::encryptUserId($user_id);
    
        return response()->json([
            'img_url' => config('app.url') . '/membercard/'.$encryptedId,
        ]);
    }

}
