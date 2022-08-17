<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class StockResource extends JsonResource
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
            'product_id' => $this->product_id,
            'size_id' => $this->size_id,
            'size_name' => $this->size->size_name,
//            'color_id' => $this->color_id,
//            'color_name' => $this->color->color_name,
            'quantity' => $this->quantity,
            'unit_of_measure' => $this->unit_of_measure,
        ];
    }
}
