<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Parchase extends Model
{
    use HasFactory;
    public function wing() {
        return $this->hasOne(Wing::class,'id', 'wing_id');
    }
    public function product() {
        return $this->hasOne(Product::class,'id', 'product_id');
    }
}
