<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class OrderCollection extends JsonResource
{
    /**
     * Transform the resource collection into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        return [
            'id'    => $this->id,
            'price' => $this->price,
            'type'  => $this->type,
            'dineIns' => $this->dineIns->transform(function($page){
                return [
                    'id'   => $page->id,
                    'service_charge' => $page->service_charge,
                    'table' => $page->table->table_number,
                    'waiter' => $page->waiter->waiter_name
                ];
            }),
            'delivery' => $this->delivery->transform(function($page){
                return [
                    'id'   => $page->id,
                    'delivery_fees' => $page->delivery_fees,
                    'customer_phone'    => $page->customer_phone,
                    'customer_name'     => $page->customer_name
                ];
            }),
            'orderItems' => $this->orderItems->transform(function($page){
                return [
                    'id'   => $page->id,
                    'item_name' => $page->item->name,
                    'item_price'    => $page->item->price,
                    'qty'    => $page->qty,
                ];
            }),

            
        ];


    }
}
