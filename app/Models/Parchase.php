<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Parchase extends Model
{
    use HasFactory;
    protected $fillable = [
        "supplier",
        "reference_no",
        "purchase_date",
        "purchase_status",
        "product_id",
        "payment_method",
        "status_type",
        "quantity",
        "wing_id",
        "account_number",
        "bank_id"
    ];
    protected $casts = [
        'product_id' => 'integer',
        'quantity' => 'integer',
        'wing_id' => 'integer',
        'bank_id' => 'integer',
        "transaction_id" => 'integer'
    ];

    public function wing()
    {
        return $this->hasOne(Wing::class, 'id', 'wing_id');
    }
    public function product()
    {
        return $this->hasOne(Product::class, 'id', 'product_id');
    }
    // get single amount from product procice and quantity
    public function scopeAmount($query)
    {
        return $this->product()->where(["id" => $this->product_id])->first()->price * $this->quantity;
    }
}
