<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Support\Facades\Storage;

class Event extends Model
{
    use HasFactory;

    protected $guarded = [];

    protected $casts = [
        'media' => 'array',
    ];

    protected $appends = [
        'images_url'
    ];

    protected function imagesUrl(): Attribute
    {
        return Attribute::make(
            get: function (){
                return array_map(fn ($image) => Storage::url($image) ,$this->media);
            }
        );
    }

    public function category(){
        return $this->belongsTo('App\Models\Category');
    }
}
