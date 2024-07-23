<?php

namespace App\Livewire\Motorcycle;

use App\Models\Brand;
use App\Models\Product;
use Livewire\Component;
use App\Models\Category;
use Livewire\Attributes\Url;
use Livewire\WithPagination;
use Spatie\SchemaOrg\Schema;
use Livewire\Attributes\Title;

class Index extends Component
{
    use WithPagination;

    public $search = '';
    public $categories;
    public $brands;
    #[Url]
    public $selectedCategory = '';
    #[Url]
    public $selectedBrand = '';
    public $selectedPrice = '';

    #[Url]
    public $minPrice = 0;
    #[Url]
    public $maxPrice = 300000;

    public function mount()
    {
        $this->categories = Category::all();
        $this->brands = Brand::all();
    }

    #[Title('Motorcycle Lists')]
    public function render()
    {
        $title = config('app.name');
        $description = 'Lorem ipsum...';
        $url = route('motorcycles.index');

        seo()
            ->title($title)
            ->description($description)
            ->canonical($url)
            ->addSchema(
                Schema::webPage()
                    ->name($title)
                    ->description($description)
                    ->url($url)
                    ->author(Schema::organization()->name($title))
            );

        $brands = Brand::all();
        $categories = Category::all();

        return view('livewire.motorcycle.index', ['products' => $this->products, 'brands' => $brands, 'categories' => $categories]);
    }

    /**
     * Get products based on selected filters.
     *
     * @return \Illuminate\Pagination\LengthAwarePaginator
     */
    public function getProductsProperty()
    {
        $products = Product::when($this->selectedBrand, function ($query, $selectedBrand) {
            $query->where('brand_id', $selectedBrand);
        })
            ->when($this->selectedCategory, function ($query, $selectedCategory) {
                $query->where('category_id', $selectedCategory);
            })
            ->when($this->minPrice, function ($query, $minPrice) {
                $query->where('price', '>=', $minPrice);
            })
            ->when($this->maxPrice, function ($query, $maxPrice) {
                $query->where('price', '<=', $maxPrice);
            })
            ->when($this->search, function ($query, $search) {
                $query->where(function ($query) use ($search) {
                    $query->where('name', 'like', '%' . $search . '%')
                          ->orWhere('description', 'like', '%' . $search . '%');
                });
            })
            ->latest()
            ->paginate(6);

        return $products;
    }
}
