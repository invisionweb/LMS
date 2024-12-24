<?php

use App\Livewire\CourseShow;
use App\Livewire\SubjectsCourses;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
})->name('welcome');

Route::get('/courses', SubjectsCourses::class)->name('courses');
Route::get('/course/{course}/{chapter?}', CourseShow::class)->name('course.show');
