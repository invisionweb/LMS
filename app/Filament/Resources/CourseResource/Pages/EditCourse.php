<?php

namespace App\Filament\Resources\CourseResource\Pages;

use App\Filament\Resources\CourseResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;
use Filament\Support\Colors\Color;

class EditCourse extends EditRecord
{
    protected static string $resource = CourseResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\ViewAction::make('View')->url(route('course.show', ['course' => $this->record])),
            Actions\DeleteAction::make(),
        ];
    }
}
