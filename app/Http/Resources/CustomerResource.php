<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class CustomerResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {

        return [
            'id' => $this->id,
            'name' => $this->name,
            'email' => $this->email,
            'address' => $this->address,
            'type' => $this->type,
            'state' => $this->state,
            'city' => $this->city,
            'postalCode' => $this->postal_code,
            'invoices' => InvoiceResource::collection($this->whenLoaded('invoices')),
        ];
    }
}