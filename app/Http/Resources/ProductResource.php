<?php

namespace App\Http\Resources;

use App\Models\Product;
use Illuminate\Contracts\Pagination\Paginator;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

/* 
  php artisan make:resource ProductResource 
*/ 

class ProductResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array | Paginator
    {

        return [
            'user' => $request->user(),
            'identifiant' => $this->id,
            'nom du produit' => $this->name,
            'prix' => $this->price,
            'categorie' => $this->category,
        ];
    }
}
