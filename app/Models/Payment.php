<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Order;

class Payment extends Model
{
    use HasFactory;

    protected $fillable = [
        'amount',
        'payed_at'
    ];

    protected $date = [
        'payed_at'
    ];

    public function order() {
        return $this->belongsTo(Order::clss);
    }
}
