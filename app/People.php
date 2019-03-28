<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class People extends Model
{

    protected $table = "peoples";
    protected $fillable = [
        'name',
        'email',
        'date_of_birth',
        'weight',
        'height',
        'phone_number',
    ];

    public function MedicalRecords()
    {
        return $this->hasMany(MedicalRecords::class);
    }

}
