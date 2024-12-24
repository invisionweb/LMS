<?php

namespace App\Filament\Resources\CourseResource\Pages;

use App\Filament\Resources\CourseResource;
use App\Models\Course;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Wizard\Step;
use Filament\Resources\Pages\CreateRecord;

class CreateCourse extends CreateRecord
{
    protected static string $resource = CourseResource::class;
}
