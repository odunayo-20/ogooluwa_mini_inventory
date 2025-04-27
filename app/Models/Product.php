<?php

namespace App\Models;

use App\Models\Tax;
use App\Models\Sale;
use App\Models\Unit;
use App\Models\Category;
use App\Models\SalesItem;
use App\Models\ProductSupplier;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Product extends Model
{
    use HasFactory;

    protected $guarded = [];


    public function category(){
        return $this->belongsTo(Category::class);
     }

     public function additionalProduct(){
         return $this->hasMany(ProductSupplier::class);
     }

     public function salesItem(){
         return $this->hasMany(SalesItem::class);
     }

     public function sales(){
         return $this->belongsToMany(Sale::class);
     }

     public function transaction(){
        return $this->hasMany(SupplierTransaction::class);
     }

     public function suppliers()
     {
         return $this->belongsToMany(Supplier::class, 'product_suppliers')
                     ->withPivot('unit', 'price')
                     ->withTimestamps();
     }

 }
