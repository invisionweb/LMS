<?php

namespace App\Livewire;

use Illuminate\Support\Facades\DB;
use Livewire\Component;

class Search extends Component
{
    public string $search = '';

    public $search_results = [];

    public function render()
    {
        return view('livewire.search');
    }

    public function updatedSearch()
    {
        $this->search_results = empty($this->search) ? [] : DB::table('courses')
            ->where('name', 'like', $this->search . '%')
            ->limit(6)
            ->get();
    }
}
