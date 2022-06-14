<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Coupon extends Model
{
    use HasFactory;

    protected $fillable = [
        'code',
        'is_fixed_amount',
        'amount',
        'max_redemptions',
        'expires_on',
    ];

    /**
     * The accessors to append to the model's array form.
     *
     * @var array
     */
    protected $appends = [
        'label',
    ];

    protected $casts = [
        'amount' => 'decimal:2',
    ];

    public function orders()
    {
        return $this->hasMany(Order::class);
    }

    /**
     * Interact with the coupon's code.
     *
     * @return  \Illuminate\Database\Eloquent\Casts\Attribute
     */
    protected function code(): Attribute
    {
        return Attribute::make(
            get: fn ($value) => strtoupper($value),
            set: fn ($value) => strtoupper($value),
        );
    }

    public function getLabelAttribute()
    {
        return ($this->is_fixed_amount ? '€' : '').$this->amount.($this->is_fixed_amount ? '' : '%');
    }

    public function discount($total)
    {
        $discount = 0;

        if($this->is_fixed_amount)
        {
            $discount = $this->total > $this->amount ? $this->amount : $total;
        }
        else
        {
            $discount = round($total * ($this->amount/100),2);
        }

        return $discount;
    }
}
