<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class MonthlyDueResource extends JsonResource
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
            'due_date' => $this->due_date,
            'monthly_payment' => $this->monthly_payment,
            'penalty_amount' => $this->penalty_amount,
            'status' => $this->status,
            'receipt_number' => $this->receipt_number,
            'payment_method' => $this->payment_method,
            'amount_paid' => $this->amount_paid,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
        ];
    }
}
