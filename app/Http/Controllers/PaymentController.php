<?php


namespace App\Http\Controllers;

use App\Models\Cart;
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
            ->first();
        $invoice = $cart->getInvoice();

        $cart->update([
            'status' => 'processing',
        ]);

        try {
            DB::beginTransaction();
            // api to transaction
            //$transaction
//            if ($status === 'success') {
            $cart->update([
                'status' => 'success',
            ]);
            //update products inventory
            DB::commit();
            return Response::json(['status' => 'success',
                'message' => 'Pay successfully',
                'invoice' => $invoice
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
