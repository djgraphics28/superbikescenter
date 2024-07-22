<?php

namespace App\Livewire\Motorcycle;

use App\Models\Brand;
use App\Models\Product;
use Livewire\Component;
use App\Models\Category;
use Livewire\Attributes\Title;

class Index extends Component
{
    public $categories;
    public $brands;
    public $selectedCategory = '';
    public $selectedBrand = '';
    public $selectedPrice = '';

    public function mount()
    {
        $this->categories = Category::all();
        $this->brands = Brand::all();
    }

    #[Title('Motorcycle Lists')]
    public function render()
    {
        $motorcycles = Product::query()
            ->when($this->selectedCategory, function($query) {
                $query->where('category_id', $this->selectedCategory);
            })
            ->when($this->selectedBrand, function($query) {
                $query->where('brand_id', $this->selectedBrand);
            })
            ->when($this->selectedPrice, function($query) {
                list($min, $max) = explode('-', $this->selectedPrice);
                $query->whereBetween('price', [(int)$min, (int)$max]);
            })
            ->get();
        return view('livewire.motorcycle.index',[
            'motorcycles' => $motorcycles,
        ]);
    }
}
