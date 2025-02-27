<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\Pivot;

class ChapterCourse extends Pivot
{
    // link to table chapter_course
    protected $table = 'chapter_course';
}
