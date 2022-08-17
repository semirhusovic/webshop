<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class ColorResource extends JsonResource
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
            'stock_id' => $this->id,
            'color_name' => $this->color->color_name,
            'quantity' => $this->quantity,
            'hexcode' => $this->color->hexcode,
            'unit_of_measure' => $this->unit_of_measure,
        ];
    }
}
