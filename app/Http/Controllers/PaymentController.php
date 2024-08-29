<?php


namespace App\Http\Controllers;

use App\Models\Cart;
use App\Models\Order;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Response;
use Symfony\Component\HttpFoundation\Response as HttpResponse;

class PaymentController extends Controller
{
    public function pay(Request $request)
    {
        $cart = $request->user()
            ->carts
            ->where('status', 'active')
            ->first();//        $invoice = $cart->getInvoice();


        try {
            DB::beginTransaction();
            $cart->update([
                'status' => 'close',
            ]);
            // api to transaction
            //$transaction
//            if ($status === 'success') {
            $cart->update([
                'status' => 'success',
            ]);
            Order::query()->create([
                'status' => 'paid',
                'customer_id' => $cart->customer_id,
                'data' => '{}'
//                'data' => json_decode($invoice, false, 512, JSON_THROW_ON_ERROR)
            ]);
            //update products inventory

            DB::commit();
            return Response::json(['status' => 'success',
                'message' => 'Pay successfully',
                'invoice' => '{}'
//                'invoice' => $invoice
            ], HttpResponse::HTTP_CREATED);
//            }
        } catch (\Exception $e) {
            DB::rollBack();
            $cart->update([
                'status' => 'failed',
            ]);
            Response::json([
                'status' => 'error',
                'message' => $e->getMessage(),
            ], HttpResponse::HTTP_UNPROCESSABLE_ENTITY);
        }
    }

}
