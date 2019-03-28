<?php

namespace App\Http\Controllers;

use App\MedicalRecords;
use App\People;
use Illuminate\Http\Request;

class MedicalRecordsController extends Controller
{
    public function __construct()
    {
        //$this->middleware('auth');
    }

    public function index($people)
    {
        return view('viewappointment', ['allRecords' => MedicalRecords::query()->where("people_id",$people)->get(), 'people_id' => $people]);
    }

    public function create($peopleId)
    {
        $people = People::findOrFail($peopleId);
        return view('createappointment', ['people' => $people]);
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

        return redirect('/Peoples');
    }

    public function show($people)
    {
        return view('viewappointment', ['allRecords' => MedicalRecords::query()->where("people_id",$people)->get(), 'people_id' => $people]);
    }

    public function edit($people, $medicalRecords)
    {
        return view('createappointment',['medrecords' => MedicalRecords::findOrFail($medicalRecords), 'people' => People::findOrFail($people)]);
    }

    public function updateStatus ($medicalRecords, $status){
        $medRecords = MedicalRecords::findOrFail($medicalRecords);
        $medRecords->status = $status;
        $medRecords->save();

        return redirect('/Peoples');
    }
    public function update(Request $request, $medicalRecords)
    {
        $people = People::findOrFail($request->get('people_id'));

        $datetime = date("Y-m-d H:i:s",strtotime(str_replace('/','-',$request->get('date_appointment'))));

        $meAppointment = MedicalRecords::findOrFail($medicalRecords);
        $meAppointment->date_appointment = $datetime;
        $meAppointment->notes = $request->get('notes');
        $meAppointment->status = $request->get('status');
        $meAppointment->People()->associate($people);

        $meAppointment->save();

        return redirect('/Peoples');

    }

    public function destroy($medicalRecords)
    {
        $medRecords = MedicalRecords::findOrFail($medicalRecords);
        $medRecords ->delete();
        return redirect('/Peoples');
    }
}
