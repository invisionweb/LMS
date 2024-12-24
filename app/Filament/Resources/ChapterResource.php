<?php

namespace App\Filament\Resources;

use App\Filament\Resources\ChapterResource\Pages;
use App\Models\Chapter;
use App\Models\Subject;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\MarkdownEditor;
use Filament\Forms\Components\RichEditor;
use Filament\Forms\Components\Section;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Support\Enums\FontWeight;
use Filament\Tables;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;
use Illuminate\Support\HtmlString;

class ChapterResource extends Resource
{
    protected static ?string $model = Chapter::class;

    protected static ?string $navigationIcon = 'heroicon-o-book-open';

    protected static ?int $navigationSort = 1;

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
                        TextInput::make('name')
                            ->required()
                            ->columnSpan([
                                'sm' => 2,
                                'xl' => 4,
                                '2xl' => 4,
                            ]),
                        Textarea::make('video_iframe')
                            ->label('Video Iframe')
                            ->hintIcon('heroicon-o-code-bracket')
                            ->minLength(20)
                            ->helperText(new HtmlString('Use <strong>Iframe code</strong> from the video platform.'))
                            ->required()
                            ->autosize()
                            //->prefixIcon('heroicon-m-play-circle'),
                            ->columnSpan(6),
                        RichEditor::make('description')->required()
                            ->columnSpan(6),
                        FileUpload::make('thumbnail')->columnSpan(6)->required(),
                    ]),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\ImageColumn::make('thumbnail')->grow(false),
                TextColumn::make('name')->label('Name')->searchable(), //->weight(FontWeight::SemiBold),
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
            'index' => Pages\ListChapters::route('/'),
            'create' => Pages\CreateChapter::route('/create'),
            'edit' => Pages\EditChapter::route('/{record}/edit'),
        ];
    }

    public static function canAccess(): bool
    {
        return auth()->user()->email === config('app.ADMIN_EMAIL');
    }
}
