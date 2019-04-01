<?php

namespace App\Http\Controllers;

use App\Http\Resources\MedicalRecordsResource;
use App\MedicalRecords;
use App\People;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class MedicalRecordsController extends Controller
{
    public function getMedicalRecords(Request $request, $peopleId)
    {

        $medicalRecords = DB::table('medical_records')
            ->where([['status', '<>', 'C'],['people_id', '=', $peopleId]])
            ->get();
        return MedicalRecordsResource::collection($medicalRecords);
    }

    public function store(Request $request)
    {
        $people = People::findOrFail($request->get('people_id'));
        $datetime = date("Y-m-d H:i:s",strtotime(str_replace('/','-',$request->get('date_appointment'))));
        $meAppointment = new MedicalRecords();
        $meAppointment->date_appointment = $datetime;
        $meAppointment->notes = $request->get('notes');
        $meAppointment->status = $request->get('status');
        $meAppointment->People()->associate($people);

        $meAppointment->save();

        if ((new \Illuminate\Http\Request)->wantsJson()) {
            return Collection;
        }
        else return redirect('/Peoples');
    }

    public function updateStatus ($medicalRecords, $status){
        $medRecords = MedicalRecords::findOrFail($medicalRecords);
        $medRecords->status = $status;
        $medRecords->save();

        if ((new \Illuminate\Http\Request)->wantsJson()) {
            return Collection;
        }
        else return redirect('/Peoples');
    }
}
