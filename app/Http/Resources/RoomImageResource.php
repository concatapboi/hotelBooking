<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class RoomImageResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        $arrayData = [
            "image_link" => 'http://localhost:8000/images/room/'.$this->image_link,
            "is_primary" => $this->is_primary,
            "id" => $this->id,
        ];
        return $arrayData;
    }
}
