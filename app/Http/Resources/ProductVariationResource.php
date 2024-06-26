<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class ProductVariationResource extends JsonResource
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
            'color' => $this->color,
            'engine_cc' => $this->engine_cc,
            'stock' => $this->stock,
            'image' => $this->image ? config('app.url') . '/storage/' . $this->image : config('app.url') . '/storage/' . ''
        ];
    }
}
