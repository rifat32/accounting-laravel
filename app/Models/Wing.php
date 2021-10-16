<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Wing extends Model
{
    use HasFactory;
    public function wing() {
        return $this->hasOne(Wing::class,'id', 'wing_id');
    }
}
