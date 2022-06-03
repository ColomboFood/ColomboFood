<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Gloudemans\Shoppingcart\Contracts\Buyable;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Product extends Model implements Buyable
{
    use HasFactory;

    const PATH = "products";
    
    protected $fillable = [
        'name',
        'short_description',
        'description',
        'original_price',
        'selling_price',
        'tax',
        'quantity',
        'featured',
        'hidden',
    ];

    protected $casts = [
        'original_price' => 'decimal:2',
        'selling_price' => 'decimal:2',
        'price'         => 'decimal:2',
    ];

    public function scopeFeatured($query)
    {
        $query->where('featured', true);
    }

    public function scopeFilter($query, array $filters)
    {
        $query->with('categories');

        $query->when($filters['category'] ?? false, fn ($query) =>
            $query->whereHas('categories', fn($query) =>
                $query->where('category_id',$filters['category'])
            )
        );

        if($filters['orderby'] ?? false){
            switch($filters['orderby']){    
                case('price_asc'):
                    $query->orderBy('selling_price','asc');
                    break;
                case('price_desc'):
                    $query->orderBy('selling_price','desc');
                    break;
                default:
                    $query->orderBy('created_at','desc');
                    break;
            }
        }
    }

    public function categories(){
        return $this->belongsToMany(Category::class);
    }

    public function orders(){
        return $this->belongsToMany(Order::class);
    }

    public function getBuyableIdentifier($options = null){
        return $this->id;
    }

    public function getBuyableDescription($options = null){
        return $this->name;
    }

    public function getBuyablePrice($options = null){
        return $this->price;
    }

    // public function imagePath()
    // {
    //     return $this->getFirstMediaUrl();
    // }

    // public function galleryPaths()
    // {
    //     return $this->getMediaUrl();
    // }

    protected function sellingPrice(): Attribute
    {
        return Attribute::make(
            get: function ($value, $attributes) {
                return $value ?? ($attributes['original_price'] ?? null);
            },
            set: function ($value, $attributes) {
                
                return $value ?? $attributes['original_price'];
            },
        );
    }

    protected function price(): Attribute
    {
        return Attribute::make(
            get: function ($value,$attributes) {
                return $attributes['selling_price'] && $attributes['selling_price']!=$attributes['original_price'] ?
                            $attributes['selling_price'] : $attributes['original_price'];
            },
        );
    }

    public function discount()
    {
        $difference = $this->selling_price && ($this->selling_price < $this->original_price) ? $this->original_price - $this->selling_price : 0;
        if($difference) 
            $percent = round($this->original_price / $difference, 2);
        else 
            $percent = 0;
        return $percent;
    }

    public function pricePerQuantity(int $quantity)
    {
        return number_format( $this->price * $quantity , 2) ;
    }
}
