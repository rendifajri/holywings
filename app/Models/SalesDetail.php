<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SalesDetail extends Model
{
    protected $table = "sales_detail";
    protected $fillable = ['sales_id', 'item_id', 'qty', 'price'];
    
    public function sales(){
        return $this->belongsTo(Sales::class);
    }
    public function item(){
        return $this->belongsTo(Item::class);
    }
}
