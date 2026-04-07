<?php

namespace App\Livewire;

use App\Models\Product;
use Livewire\Component;

class SearchClient extends Component
{
    public string $search = '';

    public function render()
    {
        $searchResults = strlen($this->search) >= 2
            ? Product::with('category')
                ->where('name', 'like', '%' . $this->search . '%')
                ->limit(7)
                ->get()
            : collect();

        return view('livewire.search-client', compact('searchResults'));
    }
}
