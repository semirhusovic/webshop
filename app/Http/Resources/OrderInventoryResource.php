<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class OrderInventoryResource extends JsonResource
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
            'id' => $this->product->id,
            'stock_id' => $this->id,
            'product_name' => $this->product->product_name,
            'product_price' => $this->product->product_price,
            'size' => $this->size->size_name,
            'color' => $this->color->color_name,
            'quantity' => $this->whenPivotLoaded('cart_stock', function () {
                return $this->pivot->quantity;
            }),
            'quantity_in_stock' => $this->quantity,
            'product_months_of_warranty' => $this->product->product_months_of_warranty,
            'product_manufacturing_date'=> $this->product->product_manufacturing_date,
            'product_description' => $this->product->product_description,
            'country_name' => $this->product->country->country_name,
            'manufacturer_id'=>$this->product->manufacturer_id,
            'total_price' => $this->product->total_price,
            'images' => ImageResource::collection($this->product->images),
            'manufacturer' => $this->product->manufacturer->manufacturer_name,
            'discounts' => $this->product->discounts
        ];
    }
}
