<?php

namespace App\Http\Livewire\Product;

use App\Models\Review;
use App\Models\Product;
use Livewire\Component;
use Livewire\WithPagination;

class Reviews extends Component
{
    use WithPagination;
    
    public Product $product;

    public function mount($product)
    {
        $this->product = $product;
    }

    public function render()
    {
        $related_products = Product::when( !$this->product->variant_id, fn($query) => 
                $query->where('id', $this->product->id)
                    ->orWhere('variant_id', $this->product->id)
            )
            ->when( $this->product->variant_id, fn($query) =>
                $query->where('id', $this->product->variant_id)
                    ->orWhere('variant_id', $this->product->variant_id)
            )->get();

        return view('livewire.product.reviews',[
            'reviews' => Review::whereIn('product_id', $related_products->pluck('id'))
                ->latest()
                ->paginate(5, ['*'], 'reviewsPage')
        ]);
    }
}
