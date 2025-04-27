<?php

namespace App\Models;

use App\Models\Customer;
use App\Models\SalesItem;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Sale extends Model
{
    use HasFactory;

    protected $guarded = [];




    public function salesItem(){
        return $this->hasMany(SalesItem::class, 'sale_id');
    }

    public function customer(){
        return $this->belongsTo(Customer::class, 'customer_id');
    }

}
