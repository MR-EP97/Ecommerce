<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Cart extends Model
{
    use HasFactory;

    protected $fillable = [
        'status',
        'customer_id',
    ];

    public function products(): BelongsToMany
    {
        return $this->belongsToMany(Product::class);
    }

    public function customer(): BelongsTo
    {
        return $this->belongsTo(Customer::class);
    }

    public function getInvoice()
    {
//        TODO invoice handling
//        $invoice = [];
//        $invoice['total_amount'] = $this->products()->sum('price');
//         $invoice['total_number'] = $this->products()->count();
//         $invoice['id'] = $this->id;
//        foreach ($this->products as $key => $product) {
//            $invoice['product'][$key] = $product->name;
//        }
//        return $invoice;
    }
}
