<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Support\Facades\Storage;
use Carbon\Carbon;

class Post extends Model
{
    use HasFactory;

    protected $guarded = [];

    protected $casts = [
        'media' => 'array',
    ];

    protected $appends = [
        'images_url',
        'published_at_formatted',
        'is_liked',
    ];

    protected function imagesUrl(): Attribute
    {
        return Attribute::make(
            get: function (){
                return array_map(fn ($image) => Storage::url($image) ,$this->media);
            }
        );
    }

    protected function publishedAtFormatted(): Attribute
    {
        return Attribute::make(
            get: function (){
                return Carbon::parse($this->published_at)->format('d/m/Y');
            }
        );
    }

    public function getIsLikedAttribute()
    {
        return $this->users_likes->where('id', auth('sanctum')->id())->isNotEmpty();
    }

    public function users_likes()
    {
        return $this->belongsToMany(User::class);
    }
}
