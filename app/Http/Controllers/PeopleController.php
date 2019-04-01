<?php

namespace App\Http\Controllers;

use App\Http\Resources\PeopleResource;
use App\MedicalRecords;
use App\People;
use Illuminate\Contracts\Session\Session;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class PeopleController extends Controller
{
    public function getPeoples(Request $request)
    {
        $peoples = People::all();
        return PeopleResource::collection($peoples);
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

        if ((new \Illuminate\Http\Request)->wantsJson()) {
            return Collection;
        }
        else return redirect('/Peoples');
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

        if ((new \Illuminate\Http\Request)->wantsJson()) {
            return Collection;
        }
        else return redirect('/Peoples');
    }

    public function validateDelete($person){
        $date = new \DateTime();
        $date = $date->format('Y-m-d H:i:s');
        $records = MedicalRecords::query()->where([['date_appointment', '>=', $date],['people_id', '=', $person], ['status', '<>', 'C']])->get();
        if (count($records) ===0) return json_encode(array('canDelete' => true));
        else return json_encode(array('canDelete' => false));
    }

    public function validateDelete1($person){
        $date = new \DateTime();
        $date = $date->format('Y-m-d H:i:s');
        $records = MedicalRecords::query()->where([['date_appointment', '>=', $date],['people_id', '=', $person], ['status', '<>', 'C']])->get();
        if ((new \Illuminate\Http\Request)->wantsJson()) {
            return Collection;
        }
        else {
            if (count($records) ===0) return true;
            else return false;
        }
    }

    public function destroy($person)
    {
        if ($this->validateDelete1($person)) {
            $people = People::findOrFail($person);
            $people->delete();
        }
        return redirect('/');
    }

}
