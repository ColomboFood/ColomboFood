<?php

namespace App\Models;

use Illuminate\Support\Str;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Address extends Model
{
    use HasFactory;

    protected $fillable = [
        'email',
        'phone',
        'full_name',
        'address',
        'city',
        'province',
        'country_region',
        'postal_code',
        'billing',
        'default',
        'user_id',
        'label',
    ];

    /**
     * The accessors to append to the model's array form.
     *
     * @var array
     */
    protected $appends = [
        'label',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    /**
     * 
     *      Print with {!!  !!}
     * 
     */
    public function getLabelAttribute()
    {
        $label=null;
        
        $label="$this->full_name";

        if(Str::length($label)) $label.="\n";

        $label.="$this->address";

        if(Str::length($label)) $label.="\n";
        $label.="$this->city";
        if($this->province)
            $label.=" ($this->province)";
        if($this->postal_code && ($this->city || $this->province))
            $label.=", ";
        $label.="$this->postal_code";

        if(Str::length($label)) $label.="\n";
        $label.="$this->country_region";

        return $label ? nl2br(e($label)) : null;
    }
}
