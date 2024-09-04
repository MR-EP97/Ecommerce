<?php

namespace App\Models;

use App\States\OrderState;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Spatie\ModelStates\HasStates;
use App\States\OrderStates\{Delivered, Paid, Preparing, Shipping};

class Order extends Model
{
    use HasFactory, HasStates;

    protected $fillable = [
        'data',
        'status',
        'customer_id'
    ];

//    protected $casts = [
//        'state' => OrderState::class
//    ];


    public function customer(): BelongsTo
    {
        return $this->belongsTo(Customer::class);
    }


}
