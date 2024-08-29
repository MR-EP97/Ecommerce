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
        // سه مقددار برای تعداد داریم . 1- تعداد محصولات سفارش داده شده بر حسب نوع. 2 -تعداد کل محصولات سافرش داده شده 3- تعداد ر هر نوع
        // مثال فرض کنیم 1عدد گوشی ،2عدد لیوان ، 3عدد دفتر سفارش داده شده است
        // 1- 3تا سفارش داریم . 2- 6تا . 3- در هر دیتا تعداد جداگانه ارسال شود مثلا 1 گوشی ، 2لیوان و ...
//         $invoice['id'] = $this->id;
//        foreach ($this->products as $key => $product) {
//            $invoice[$key]['product'] = $product->name;
//            $invoice[$key]['seller'] = $product->seller->name;
//            $number = $product->number;
//        }
//        return $invoice;
    }
}
