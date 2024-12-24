<?php

namespace App\Livewire;

use App\Models\Course;
use App\Models\Shop\Brand;
use App\Models\Subject;
use Filament\Forms\Concerns\InteractsWithForms;
use Filament\Forms\Contracts\HasForms;
use Filament\Infolists\Components\Section;
use Filament\Infolists\Components\Tabs;
use Filament\Infolists\Components\TextEntry;
use Filament\Infolists\Concerns\InteractsWithInfolists;
use Filament\Infolists\Contracts\HasInfolists;
use Filament\Infolists\Infolist;
use Livewire\Component;

class SubjectsCourses extends Component implements HasForms, HasInfolists
{
    use InteractsWithForms;
    use InteractsWithInfolists;

    public $subjects = [];

    public $courses = [];

    public function mount()
    {
        $this->subjects = Subject::all()->pluck('name', 'id');
        $this->courses = Course::all();
    }

    public function render()
    {
        return view('livewire.subjects-courses');
    }

    public function productInfolist(Infolist $infolist): Infolist
    {
        $brand = Brand::find(1);

        return $infolist
            ->record($brand)
            /*->state([
                'name' => 'MacBook Pro',
                'category' => [
                    'name' => 'Laptops',
                ],
                // ...
            ])*/
            ->schema([
                Section::make('All the skills you need in one place')
                    ->description('From critical skills to technical topics, Udemy supports your professional development.')
                    ->schema([
                        Tabs::make('Tabs')
                            ->tabs([
                                Tabs\Tab::make('Tab 1')
                                    ->schema([
                                        TextEntry::make('name'),
                                    ]),
                                Tabs\Tab::make('Tab 2')
                                    ->schema([
                                        // ...
                                        TextEntry::make('name'),
                                        TextEntry::make('description'),
                                    ]),
                                Tabs\Tab::make('Tab 3')
                                    ->schema([
                                        // ...
                                    ]),
                            ]),
                        //->contained(false),
                    ]),
                Tabs::make('Tabs')
                    ->tabs([
                        Tabs\Tab::make('Tab 1')
                            ->schema([
                                TextEntry::make('name'),
                            ]),
                        Tabs\Tab::make('Tab 2')
                            ->schema([
                                // ...
                                TextEntry::make('name'),
                                TextEntry::make('description'),
                            ]),
                        Tabs\Tab::make('Tab 3')
                            ->schema([
                                // ...
                            ]),
                    ]),
                //->contained(false),
            ]);
    }
}
