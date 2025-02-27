<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;

class Course extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'description',
        'thumbnail',
        'price',
        'striked_price',
        'subject_id'
    ];

    public function related_subject(): HasOne
    {
        return $this->hasOne(Subject::class, 'id', 'subject_id');
    }

    public function related_chapters(): BelongsToMany
    {
        return $this->belongsToMany(Chapter::class, 'chapter_course', 'course_id', 'chapter_id')->withTimestamps()->orderBy('order');
        //return $this->belongsToMany(Chapter::class)->withTimestamps();
    }

    public function chapters(): HasMany
    {
        return $this->hasMany(ChapterCourse::class)->orderBy('order');
    }

    public function payments(): HasMany
    {
        return $this->hasMany(Payment::class);
    }
}
