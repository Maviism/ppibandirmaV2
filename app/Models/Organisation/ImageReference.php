<?php

namespace App\Models\Organisation;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Organisation\designRequest;

class ImageReference extends Model
{
    use HasFactory;

    protected $fillable = [
        'img_reference_url'
    ];

    public function designRequest()
    {
        return $this->belongsTo(DesignRequest::class);
    }
}
