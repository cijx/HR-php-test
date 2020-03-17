<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    public function partner(){
        return $this->belongsTo(Partner::class);
    }

    public function products()
    {
        return $this->belongsToMany(Product::class,'order_products')->withPivot(["quantity","price"])->withTimestamps();
    }

    public function getSumAttribute()
    {
        return $this->products->sum("pivot.price");
    }

}
