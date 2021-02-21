<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Payment;
use App\Models\User;
use App\Models\Product;

class Order extends Model
{
    use HasFactory;
    
    protected $fillable = [
        'status',
        'user_id'
    ];

    public function payment() {
        return $this->hasOne(Payment::class);
    }

    public function user() {
        return $this->belongsTo(User::class);
    }

    public function products() {
        return $this->morphToMany(Product::class, 'productable')->withPivot('quantity');
    }

    public function getTotalAttribute() {
        return $this->products->pluck('total')->sum();
    }
}
