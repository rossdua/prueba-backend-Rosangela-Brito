<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    protected $fillable = [
        'name', 
        'description', 
        'price', 
        'currency_id', 
        'tax_cost', 
        'manufacturing_cost'
    ];

    // Relación con la divisa base del producto
    public function baseCurrency()
    {
        return $this->belongsTo(Currency::class, 'currency_id');
    }

    // Relación con los precios en diferentes divisas
    public function prices()
    {
        return $this->hasMany(ProductPrice::class);
    }
}
