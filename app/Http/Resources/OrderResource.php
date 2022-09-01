<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class OrderResource extends JsonResource
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
            'first_name' => $this->first_name,
            'last_name' => $this->last_name,
            'phone_number' => $this->phone_number,
            'billing_address' => $this->billing_address,
            'city' => $this->city,
            'email' => $this->email,
            'cc_number' => $this->cc_number,
            'total_amount' => $this->total_amount,
            'status' => $this->status->status_name,
            'created_at' => $this->created_at,
            'invoice_status' => $this->invoice->status->status_name,
            'invoice_id' => $this->invoice->id
        ];
    }
}
