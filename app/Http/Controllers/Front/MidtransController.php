<?php

namespace App\Http\Controllers\Front;

use App\Models\Order;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class MidtransController extends Controller
{
    public function midtrans()
    {
        if (Session::has('order_id')) { // if there's an order has been placed (and got redirected from inside the checkout() method inside Front/ProductsController.php)    // 'user_id' was stored in Session inside checkout() method in Front/ProductsController.php
            return view('front.iyzipay.iyzipay');

        } else { // if there's no order has been placed
            return redirect('cart'); // redirect user to cart.blade.php page
        }
    }
}

?>