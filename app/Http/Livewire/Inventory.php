<?php

namespace App\Http\Livewire;

use App\Models\Items;
use Livewire\Component;

class Inventory extends Component
{
    public $search = '';
    public $stockItems;

    protected $queryString = [
        'search' => ['except' => '', 'as' => 's'],
        // 'page' => ['except' => 1, 'as' => 'p'],
    ];
    public function mount()
    {
        $this->stockItems = $this->getStockItems();
    }
    public function getStockItems()
    {
        return Items::with(['price.purchase','stock'])->where(function($query){
            return $query->where('title', 'like', '%'.$this->search.'%')
            ->orWhere('type', 'like', '%'.$this->search.'%')
            ->orWhere('description', 'like', '%'.$this->search.'%');
        })->get();
    }

    public function render()
    {
        $this->stockItems = $this->getStockItems();
        return view('livewire.inventory');
    }
}
