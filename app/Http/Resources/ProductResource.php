<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class ProductResource extends JsonResource
{

    public function toArray($request): array|\JsonSerializable|\Illuminate\Contracts\Support\Arrayable
    {
        return [
            'id' => $this->id,
            'product_name' => $this->product_name,
            'product_price' => $this->product_price,
            'product_months_of_warranty' => $this->product_months_of_warranty,
            'product_manufacturing_date'=> $this->product_manufacturing_date,
            'product_description' => $this->product_description,
            'unit_of_measure' => $this->unit_of_measure,
            'country_name' => $this->country->country_name,
            'manufacturer_id'=>$this->manufacturer_id,
            'total_price' => $this->total_price,
            'images' => ImageResource::collection($this->images),
            'manufacturer' => $this->manufacturer->manufacturer_name,
            'discounts' => $this->discounts,
        ];
    }
}
