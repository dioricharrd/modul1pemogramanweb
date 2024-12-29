<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class VillaEventResource extends JsonResource
{
    public function toArray($request)
    {
        return [
            'id' => $this->id,
            'villa_id' => $this->villa_id,
            'name' => $this->name,
            'description' => $this->description,
            'start_date' => $this->start_date,
            'end_date' => $this->end_date,
            'villa' => new VillaResource($this->whenLoaded('villa')), // Jika ingin menambahkan relasi ke villa
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
        ];
    }
}