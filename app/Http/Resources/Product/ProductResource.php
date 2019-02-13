<?php

namespace App\Http\Resources\Product;

use Illuminate\Http\Resources\Json\Resource;

class ProductResource extends Resource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        return [
            
            // We can change the return variable name for loose coupling. i.e. 'details' to 'description'. 
            // so that in future if we change column name detail to something else then our API end users should not ger affected

            'name' => $this->name,
            'description' => $this->detail, 
            'price' => $this->price,
            'stock' => $this->stock == 0 ? 'Out of stock': $this->stock,
            'total_price' => round( (1 - ( $this->discount / 100)) * $this->price, 2),
            'discount' => $this->discount,
            'rating' => $this->reviews()->count() > 0 ? round($this->reviews->sum('star')/$this->reviews()->count(), 2) : 'No review yet',
            'href' => [
                
                'reviews' => route('reviews.index', $this->id)
            ]

        ];
    }
}
