<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;
use App\Http\Resources\ServiceResource;

class RoomResource extends JsonResource
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
            "id" => $this->id,
            "room_name" => $this->room_name,
            "description" => $this->description,
            "price" => $this->price,
            "max_adult_amount" => $this->max_adult_amount,
            "max_child_amount" => $this->max_child_amount,
            "free_child_amount" => $this->free_child_amount,
            "child_age" => $this->child_age,
            "room_size" => $this->room_size,
            "amount" => $this->amount,
            "room_type" => $this->RoomType->name,
            "room_type_id" => $this->RoomType->id,
            "room_mode" => $this->RoomMode->name,
            "room_mode_id" => $this->RoomMode->id,
        ];
        return $arrayData;
    }
}
