<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Item extends Model
{
    protected $table = "item";
    protected $fillable = ['code', 'name', 'price'];
    
    public function salesDetail(){
        return $this->hasMany(SalesDetail::class);
    }
}
