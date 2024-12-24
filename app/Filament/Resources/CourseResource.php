<?php

namespace App\Filament\Resources;

use App\Filament\Resources\CourseResource\Pages;
use App\Models\Course;
use App\Models\Subject;
use Filament\Forms;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\Repeater;
use Filament\Forms\Components\Section;
use Filament\Forms\Components\Select;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Support\Enums\FontWeight;
use Filament\Tables;
use Filament\Tables\Columns\ImageColumn;
use Filament\Tables\Columns\Layout\Split;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;

class CourseResource extends Resource
{
    protected static ?string $model = Course::class;

    protected static ?string $navigationIcon = 'heroicon-o-film';

    protected static ?int $navigationSort = 0;

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Section::make()
                    ->columns([
                        'sm' => 3,
                        'xl' => 6,
                        '2xl' => 8,
                    ])
                    ->schema([
                        Forms\Components\TextInput::make('name')
                            ->required()
                            ->columnSpan([
                                'sm' => 2,
                                'xl' => 4,
                                '2xl' => 4,
                            ]),
                        Forms\Components\RichEditor::make('description')->required()
                            ->columnSpan([
                                'sm' => 2,
                                'xl' => 6,
                                '2xl' => 4,
                            ]),
                        FileUpload::make('thumbnail')->columnSpan(6)->required(),

                        Select::make('subject_id')
                            ->label('Subject')
                            /*
                            ->options([
                                '1' => 'Mathematics',
                                '2' => 'Computer Science',
                                '3' => 'Art',
                            ])
                            */
                            ->options(Subject::all()->pluck('name', 'id'))
                            ->required()
                            ->columnSpan(2),

                        /*Forms\Components\Select::make('subjects')
                            ->relationship('subjects', 'name')
                            ->multiple()
                            ->required()
                            ->columnSpan(2),*/

                        Forms\Components\TextInput::make('price')
                            //->required()
                            ->numeric()
                            ->columnSpan(2),
                    ]),
                Forms\Components\Select::make('related_chapters')
                    ->label("Add chapters to course")
                    ->relationship('related_chapters', 'name')
                    //->relationship()
                    ->multiple()
                    ->preload()
                    ->required()
                ->columnSpan(2),

                /* Repeater::make('chapters')
                            ->addActionLabel('Add new chapter')
                            ->hiddenLabel(true)
                            ->simple(
                                Forms\Components\Select::make('chapter_id')
                                    ->relationship('related_chapters', 'name')
                                    ->placeholder('Search and add chapters by name')
                                    ->searchable()
                                    ->required()
                                    ->preload()
                                    ->hiddenLabel(true),
                            )
                            ->defaultItems(2)
                            ->reorderableWithButtons()
                            ->grid(1),*/
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                /*Split::make([
                    ImageColumn::make('thumbnail')
                        //->circular()
                        ->grow(false),
                    TextColumn::make('name')->weight(FontWeight::Bold),
                    TextColumn::make('related_subject.name')->label('Subject'),
                ]),*/
                Tables\Columns\ImageColumn::make('thumbnail')->grow(false),
                TextColumn::make('name')->label('Name')->searchable(), //->weight(FontWeight::SemiBold),
                TextColumn::make('related_subject.name')->label('Subject'),
            ])
            ->filters([
                //
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
            ])
            ->defaultSort('updated_at', 'desc');
    }

    public static function getRelations(): array
    {
        return [
            //
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListCourses::route('/'),
            'create' => Pages\CreateCourse::route('/create'),
            'edit' => Pages\EditCourse::route('/{record}/edit'),
        ];
    }

    public static function canAccess(): bool
    {
        return auth()->user()->email === config('app.ADMIN_EMAIL');
    }
}
