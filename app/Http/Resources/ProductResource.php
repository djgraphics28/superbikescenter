<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class ProductResource extends JsonResource
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
            'slug' => $this->slug,
            'description' => $this->description,
            'image' => $this->image ? config('app.url') . '/storage/' . $this->image : config('app.url') . '/storage/' . '',
            'price' => $this->price,
            'category_id' => $this->category->name,
            'brand_id' => $this->brand->name,
            'model' => $this->model,
            'variations' => $this->variations
            // 'year' => $this->year,
            // 'engine_type' => $this->engine_type,
            // 'displacement' => $this->displacement,
            // 'horsepower' => $this->horsepower,
            // 'torque' => $this->torque,
            // 'weight' => $this->weight,
            // 'seat_height' => $this->seat_height,
            // 'created_at' => $this->created_at,
            // 'updated_at' => $this->updated_at,
            // 'deleted_at' => $this->deleted_at,
        ];
    }
}
