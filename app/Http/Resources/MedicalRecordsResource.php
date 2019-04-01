<?php

namespace App\Http\Resources;

use Carbon\Carbon;
use Illuminate\Http\Resources\Json\JsonResource;

class MedicalRecordsResource extends JsonResource
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
            'people_id'       => $this->people_id,
            'notes'      => $this->notes,
            'date_appointment'    => Carbon::parse($this->date_appointment)->format('d/m/Y'),
        ];
    }
}
