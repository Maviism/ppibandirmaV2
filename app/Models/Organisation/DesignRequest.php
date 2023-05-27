<?php

namespace App\Models\Organisation;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Organisation\ImageReference;

class DesignRequest extends Model
{
    use HasFactory;

    protected $fillable = [
        'department',
        'content',
        'title',
        'deadline',
        'responsible',
        'img_reference_url',
        'status',
        'assign_to'
    ];

    public function imageReferences()
    {
        return $this->hasMany(ImageReference::class);
    }
}
