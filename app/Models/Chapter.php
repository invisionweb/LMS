<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Chapter extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'description',
        'video_iframe',
        'thumbnail'
    ];

    public function comments(): HasMany
    {
        return $this->hasMany(Comment::class);
    }
}
