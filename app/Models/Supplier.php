<?php

namespace App\Models;

use App\Models\Product;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Supplier extends Model
{
    use HasFactory;

    protected $guarded = [];



    public function product(){
        return $this->hasMany(Product::class);
    }

    public function products()
    {
        return $this->belongsToMany(Product::class, 'product_suppliers')
                    ->withPivot('unit', 'price')
                    ->withTimestamps();
    }

    public function transactions()
    {
        return $this->hasMany(SupplierTransaction::class);
    }

}
