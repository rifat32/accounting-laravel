<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DebitNote extends Model
{
    use HasFactory;
    public function wing() {
        return $this->hasOne(Wing::class,'id', 'wing_id');
    }
    public function bill() {
        return $this->hasOne(Bill::class,'id', 'bill_id');
    }
}
