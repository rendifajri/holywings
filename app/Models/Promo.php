<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Promo extends Model
{
    protected $table = "promo";
    protected $fillable = ['code', 'name', 'discount_percent', 'min_amount', 'status'];
    
    public function sales(){
        return $this->hasMany(SalesDetail::class);
    }
}
