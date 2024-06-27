<?php

namespace App\Livewire;

use App\Models\Post;
use App\Models\Brand;
use App\Models\Product;
use Livewire\Component;
use App\Models\Category;
use Livewire\WithPagination;
use Spatie\SchemaOrg\Schema;

class Home extends Component
{
    use WithPagination;

    public $selectedPriceRange;
    public $selectedBrand;
    public $selectedCategory;


    public $minPrice = 0;
    public $maxPrice = 300000;

    protected $listeners = ['priceRangeUpdated'];

    protected $queryString = ['minPrice', 'maxPrice', 'selectedBrand', 'selectedCategory'];

    /**
     * Render the component.
     *
     * @return \Illuminate\View\View
     */
    public function render()
    {
        $title = config('app.name');
        $description = 'Lorem ipsum...';
        $url = route('home');

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

        return view('livewire.home', ['products' => $this->products, 'brands' => $brands, 'categories' => $categories]);
    }

    public function priceRangeUpdated($data)
    {
        $this->minPrice = $data['minPrice'];
        $this->maxPrice = $data['maxPrice'];
        $this->resetPage(); // If using pagination, reset to page 1
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
            ->latest()
            ->paginate(6);

        return $products;
    }
}
