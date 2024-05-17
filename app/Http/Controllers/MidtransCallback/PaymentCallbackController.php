<?php

namespace App\Http\Controllers\MidtransCallback;

use App\Models\Order;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Services\Midtrans\CallbackService;
use Illuminate\Support\Facades\Log;

class PaymentCallbackController extends Controller
{
    public function receive()
    {
        $callback = new CallbackService;
        
        if($callback->isSignatureKeyVerified()) {
            
            $notification = $callback->getNotification();
            $order = $callback->getOrder();

            if($callback->isSuccess()) {
                Order::where('id', $order->id)->update([
                    'order_status' => 'paid'
                ]);
            }

            if($callback->isExpire()) {
                Order::where('id', $order->id)->update([
                    'order_status' => 'expired'
                ]);
            }

            if($callback->isCancelled()) {
                Order::where('id', $order->id)->update([
                    'order_status' => 'Cancelled'
                ]);
            }
            
            Order::save();

            return response()->json([
                'success' => true,
                'message' => 'Notifikasi berhasil diproses'
            ], 200);
        } else {
            return response()
                ->json([
                    'error' => true,
                    'message' => 'Signature key tidak terverifikasi'
                ], 403);
        }

    }

    public function finish(Request $request) 
    {
        $message = json_decode(request("message"));
        return redirect('/')->with( ['message' => $message]);
    } 
    
    public function unfinish(Request $request) 
    {
        $message = json_decode(request("message"));
        return redirect('/')->with( ['message' => $message]);
    }

    public function error(Request $request) 
    {
        $message = json_decode(request("message"));
        return redirect('/')->with( ['message' => $message]);
    }
}
