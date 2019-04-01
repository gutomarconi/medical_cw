<?php

namespace App\Http\Resources;

use Carbon\Carbon;
use Illuminate\Http\Resources\Json\JsonResource;

class PeopleResource extends JsonResource
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
            'id'       => $this->id,
            'name'       => $this->name,
            'email'      => $this->email,
            'date_of_birth'    => Carbon::parse($this->date_of_birth)->format('d/m/Y'),
            'phone_number' => $this->phone_number,
            'height' => $this->height,
            'weight' => $this->weight,
            ];
    }
}
