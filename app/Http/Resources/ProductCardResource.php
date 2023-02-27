<?php

namespace App\Http\Resources;

use App\Models\Product;
use Illuminate\Http\Resources\Json\JsonResource;

class ProductCardResource extends JsonResource
{
    public function toArray($request)
    {
        $product = Product::find($this->product_id);

        return [
            'id' => $this->id,
            'product_id' => $this->product_id,
            'name' => $product->name,
            'description' => $product->description,
            'price' => $product->price
        ];
    }
}
