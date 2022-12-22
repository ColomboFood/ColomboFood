<?php

namespace App\Http\Livewire\Product;

use App\Models\Brand;
use App\Models\Product;
use Livewire\Component;
use App\Models\Category;
use App\Models\Collection;
use Illuminate\Support\Str;
use Livewire\WithPagination;

class Index extends Component
{
    use WithPagination;

    public $categories;
    public $brands;
    public $collections;
    public $openMenus;
    
    public $query;
    public $category;
    public $brand = [];
    public $collection = [];
    public $orderby;

    protected $queryString = [
        'query' => ['except' => ''],
        'category' => ['except' => ''],
        'brand' => ['except' => false],
        'collection' => ['except' => false],
        'orderby' => ['except' => '']
    ];

    public function updatingQuery()
    {
        $this->resetPage();
    }

    public function updatingCategory()
    {
        $this->resetPage();
    }

    public function updatingBrand()
    {
        $this->resetPage();
    }

    public function updatingCollection()
    {
        $this->resetPage();
    }

    public function resetFilters()
    {
        $this->reset(['query', 'category', 'brand', 'collection', 'orderby']);
    }

    public function isParentCategorySelected($menuCategory)
    {
        return $menuCategory->id == $this->category || $menuCategory->slug == $this->category ||
            $this->categories->where('parent_id',$menuCategory->id)->pluck('id')->contains($this->category) ||
            $this->categories->where('parent_id',$menuCategory->id)->pluck('slug')->contains($this->category);
    }

    public function setOpenMenus()
    {
        $this->openMenus = Str::of('');
        if ($this->category)
        {
            $categoryModel = Category::where('id', $this->category)->orWhere('slug', $this->category)->first();
            $this->openMenus = Str::of($categoryModel->hierarchyPath())->explode('>');
        }
    }

    public function toggleCategory($category)
    {
        $categoryModel = Category::where('id', $category)->orWhere('slug', $category)->first();
        if($this->category == $categoryModel->slug) $this->category = $categoryModel->parent ? $categoryModel->parent->slug : null;
        else $this->category = $categoryModel->slug;
        $this->setOpenMenus();
    }

    public function mount()
    {
        $this->categories = Category::all();
        $this->collections = Collection::all();
        $this->brands = Brand::all();
        $this->setOpenMenus();
    }

    public function render()
    {
        $this->categories = Category::filterByProducts([
            'query' => $this->query,
            'collection' => $this->collection,
            'brand' => $this->brand,
        ])->get();

        $this->collections = Collection::filterByProducts([
            'query' => $this->query,
            'category' => $this->category,
            'brand' => $this->brand,
        ])->get();

        $this->brands = Brand::filterByProducts([
            'query' => $this->query,
            'category' => $this->category,
            'collection' => $this->collection,
        ])->get();

        return view('product.index',[
            'products' => Product::filter([
                'query' => $this->query,
                'category' => $this->category,
                'brand' => $this->brand,
                'collection' => $this->collection
            ])->paginate(36)
        ]);
    }
}
