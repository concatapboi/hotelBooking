<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;
use Carbon\Carbon;

class PolicyResource extends JsonResource
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
            "check_in" => Carbon::parse($this->check_in)->format('H:i'),
            "check_out" => Carbon::parse($this->check_out)->format('H:i'),
            "cancel_day" => $this->cancelable,
            "refundRate" => $this->can_refund,
            "detailPolicy" => $this->content,
        ];
        return $arrayData;
    }
}
