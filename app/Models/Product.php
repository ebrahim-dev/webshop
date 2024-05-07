<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;
    public function Carts(){
        return $this->hasMany(Cart::class);
    }
        public function Category(){
        return $this->belongsTo(Category::class,'category_id');
    }
        public function ProductPhoto(){
        return $this->hasMany(ProductPhoto::class);
    }
}
