<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class CartResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        return [
            'id' => $this->id,
            'product_name' => $this->product_name,
            'product_price' => $this->product_price,
            'quantity' => $this->whenPivotLoaded('cart_product', function () {
                return $this->pivot->quantity;
            }),
            'product_months_of_warranty' => $this->product_months_of_warranty,
            'product_manufacturing_date'=> $this->product_manufacturing_date,
            'product_description' => $this->product_description,
            'country_name' => $this->country->country_name,
            'manufacturer_id'=>$this->manufacturer_id,
            'total_price' => $this->total_price,
            'images' => ImageResource::collection($this->images),
            'manufacturer' => $this->manufacturer->manufacturer_name,
            'discounts' => $this->discounts
        ];
    }
}
