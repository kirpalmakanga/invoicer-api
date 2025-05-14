<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class InvoiceResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array

     */
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'reference' => $this->reference,
            'customerId' => $this->customer_id,
            'items' => $this->items,
            'paymentMethod' => $this->payment_method,
            'status' => $this->status,
            'dateCreated' => $this->date_created,
            'dateSent' => $this->date_sent,
        ];
    }
}
