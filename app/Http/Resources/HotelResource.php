<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;
use App\Http\Resources\HotelImageResource;

class HotelResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        $arrayImage = [];
        foreach($this->Image as $image){
            $arrayImage[] = new HotelImageResource($image);
        }
        $arrayData = [
            "id" => $this->id,
            "name" => $this->name,
            "description" => $this->description,
            "meta_name" => $this->meta_name,
            "credit_card" => $this->credit_card,
            "review_point" => $this->review_point,
            "fax_number" => $this->fax_number,
            "tax_code" => $this->tax_code,
            "hotel_type" => $this->HotelType->name,
            "coin" => $this->coin,
            "stars_num" => $this->stars_num,
            "address" => $this->address,
            "phone_number" => $this->phone_number,
            "images" => $arrayImage,
        ];
        return $arrayData;
    }
}
