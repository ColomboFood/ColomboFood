<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Coupon extends Model
{
    use HasFactory;

    protected $fillable = [
        'code',
        'fixed_amount',
        'amount',
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

    public function getLabelAttribute()
    {
        return ($this->fixed_amount ? '€' : '').$this->amount.($this->fixed_amount ? '' : '%');
    }
}
