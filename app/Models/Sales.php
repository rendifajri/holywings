<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Sales extends Model
{
    protected $table = "sales";
    protected $fillable = ['customer_id', 'promo_id', 'discount_percent', 'date'];
    
    public function customer(){
        return $this->belongsTo(Customer::class);
    }
    public function promo(){
        return $this->belongsTo(Promo::class);
    }
    public function salesDetail(){
        return $this->hasMany(SalesDetail::class)->selectRaw("*, (qty * price) as sub_total");
    }
}
