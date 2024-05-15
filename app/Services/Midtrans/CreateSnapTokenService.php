<?php

namespace App\Services\Midtrans;

use Midtrans\Snap;
use App\Models\OrdersProduct;

class CreateSnapTokenService extends Midtrans 
{
    protected $order;

    public function __construct($order) 
    {
        parent::__construct();

        $this->order = $order;
    }

    public function getSnapToken() 
    {
        $item_details = OrdersProduct::where('order_id', $this->order->id)->get();
        $details = [];
        foreach ($item_details as $key => $value) {
            $details[] = [
                'id' => $value->product_id,
                'price' => $value->product_price,
                'quantity' => $value->product_qty,
                'name' => $value->product_name
            ];
        }

        $params = [
                'transaction_details' => [
                    'order_id' => $this->order->id,
                    'gross_amount' => $this->order->grand_total,
                ],
                'item_details' => $details , 
                'customer_details' => [
                    'first_name' => $this->order->name,
                    'email' => $this->order->email,
                    'phone' => $this->order->phone
                ]
            ];

            $snapToken = Snap::getSnapToken($params);
            
            return $snapToken;
    }
}

?>