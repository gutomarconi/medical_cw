<?php

namespace App\Http\Controllers;

use App\MedicalRecords;
use App\People;
use Illuminate\Contracts\Session\Session;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class PeopleController extends Controller
{
    public function __construct()
    {
        //$this->middleware('auth');
    }

    public function index()
    {
        return view('viewpeople', ['allPeoples' => People::all()]);
    }

    public function create()
    {
        return view('createpeople');
    }

    public function store(Request $request)
    {
        $date = $this->formatDate($request->get('date_of_birth'));

        People::create([
            'name' => $request->get('name'),
            'email' => $request->get('email'),
            'height' => $request->get('height'),
            'weight' => ($request->get('weight')),
            'date_of_birth' => $date,
            'phone_number' => ($request->get('phone_number'))
        ]);

        return redirect('/Peoples');
    }

    public function show($person)
    {
        return view('showpeople', ['people' => People::findOrFail($person)]);
    }

    public function edit($person)
    {
        return view('createpeople',['people' => People::findOrFail($person)]);
    }

    private function formatDate ($date){
        return  date("Y-m-d H:i:s",strtotime(str_replace('/','-',$date)));
    }

    public function update(Request $request,$person)
    {
        $date = $this->formatDate($request->get('date_of_birth'));

        $people = People::findOrFail($person);
        $people->name = $request->get('name');
        $people->email = $request->get('email');
        $people->height = $request->get('height');
        $people->weight = $request->get('weight');
        $people->date_of_birth = $date;
        $people->phone_number = $request->get('phone_number');

        $people->save();

        return redirect('/Peoples');
    }

    public function validateDelete($person){
        $date = new \DateTime();
        $date = $date->format('Y-m-d H:i:s');
        $records = MedicalRecords::query()->where([['date_appointment', '>=', $date],['people_id', '=', $person], ['status', '<>', 'C']])->get();
        if (count($records) ===0) return true;
        else return false;
    }

    public function destroy($person)
    {
        if (!$this->validateDelete($person)) {
            return view('layouts/error', ['error' => "This patient have outstanding appointments. Cannot delete!"]);
        }
        else {
            $people = People::findOrFail($person);
            $people->delete();
            return redirect('/Peoples');
        }
    }

}
