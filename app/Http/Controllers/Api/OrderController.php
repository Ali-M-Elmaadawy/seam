<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Order;
use App\Models\Item;
use App\Models\Table;
use App\Models\Waiter;
use App\Http\Resources\OrderCollection;

class OrderController extends Controller
{
    public function make_order() {

        $validator = \Validator::make(request()->all(), [
            'items'                 => 'required|array',
            'items.*.id'            => 'required|exists:items,id',
            'items.*.quantity'      => 'required|numeric',
            'type'                  => 'required|in:dine-in,delivery',

        ]);

        if ($validator->fails()) {
            return response()->json(['success' => false, 'error' => $validator->errors()->all()], 200);
        }


        if(request('type') == 'dine-in') {

            $order = auth('api')->user()->orders()->create([
                'type'  => request('type')
            ]);

            $totalPrice = 0;

            foreach(request('items') as $item) {

                $one_item = Item::find($item['id']);
                $totalPrice +=   $one_item->price * $item['quantity']; 

                $order->orderItems()->create([
                    'order_id'  => $order->id,
                    'item_id'   => $one_item->id,
                    'qty'       => $item['quantity'],
                    'price'     => $one_item->price
                ]);                 
            }

            $tables = Table::pluck('id')->toArray();
            shuffle($tables);
            $waiters = Waiter::pluck('id')->toArray();
            shuffle($waiters);
            $order->dineIns()->create([
                'table_id'          => $tables[0],
                'waiter_id'         => $waiters[0],
                'service_charge'    => $totalPrice * (12 / 100)
            ]);

            $order->update(['price' => $totalPrice]);    
        } elseif(request('type') == 'delivery') {

            $validator = \Validator::make(request()->all(), [

                'customer_phone' => 'required|numeric',
                'customer_name'  => 'required|string'    

            ]);

            if ($validator->fails()) {
                return response()->json(['success' => false, 'error' => $validator->errors()->all()], 200);
            }

            $order = auth('api')->user()->orders()->create([
                'type'  => request('type')
            ]);

            $totalPrice = 0;

            foreach(request('items') as $item) {

                $one_item = Item::find($item['id']);
                $totalPrice +=   $one_item->price * $item['quantity']; 

                $order->orderItems()->create([
                    'order_id'  => $order->id,
                    'item_id'   => $one_item->id,
                    'qty'       => $item['quantity'],
                    'price'     => $one_item->price
                ]);                 
            }

            $order->delivery()->create([
                'customer_phone' => request('customer_phone'),
                'customer_name'  => request('customer_name')
            ]);      
            $order->update(['price' => $totalPrice]);      
        }

        return response()->json(['success' => true , 'data' => 'Order Success Submitted']);
        
    }   

    public function my_orders() {

        $orders = auth()->user()->orders()->with(['orderItems','dineIns' , 'delivery'])->get();
        return response()->json(['success' => true , 'data' => OrderCollection::collection($orders)]);
    }
}
