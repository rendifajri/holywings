<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Sales extends Model
{
    protected $table = "sales";
    protected $fillable = ['customer_id', 'date'];
    
    public function customer(){
        return $this->belongsTo(Customer::class);
    }
    public function salesDetail(){
        return $this->hasMany(SalesDetail::class)->selectRaw("*, (qty * price) as sub_total");
    }
}
