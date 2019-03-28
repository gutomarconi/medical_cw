<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class MedicalRecords extends Model
{
    protected $fillable = [
        'date_appointment',
        'notes',
        'people_id',
        'status',
    ];

    //protected $guarded = ['people_id'];

    public function People()
    {
        return $this->belongsTo(People::class);
    }
}
