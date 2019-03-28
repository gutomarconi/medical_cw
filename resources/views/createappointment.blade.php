<?php
/**
 * Created by PhpStorm.
 * User: Gustavo
 * Date: 22/03/2019
 * Time: 19:11
 */
?>
@extends('layouts.app')

@section('content')

<div class="container">
    <div class="content">
        @if(empty($medrecords))
            <form method="POST" action={{ route('Medrecords.store') }}>
            <h5> New appointment for {{$people->name}}</h5>
        @else
            <form method="POST" action={{ route('Medrecords.update', $medrecords->id) }}>
            <h5> Edit appointment</h5>
            {{ method_field('PUT') }}
        @endif
            @csrf
            <br>
            <div class="row">
                <div class="input-field col s12">
                    <input type="hidden" id="people_id" name="people_id" value={{$people->id}}>
                    @if(empty($medrecords))
                        <input placeholder="01/01/1980" id="date_appointment" type="date" class="validate" name="date_appointment">
                        <input type="hidden" id="status" name="status" value="O">
                    @else
                        <input id="date_appointment" type="text" class="validate" name="date_appointment" value="{{date('d/m/Y', strtotime($medrecords->date_appointment))}}">
                        <input type="hidden" id="status" name="status" value="{{$medrecords->status}}">
                    @endif
                    <label for="date_appointment">Date appointment</label>
                </div>
            </div>

            <div class="row">
                <div class="input-field col s12">
                    <div class="form-group">
                        <label for="Notes">Notes</label>
                        @if(empty($medrecords))
                        <input class="form-control" id="Notes" rows="3" name="notes"/>
                        @else
                        <input id="Notes" class="form-control" rows="3" name="notes" value="{{$medrecords->notes}}"/>
                        @endif
                    </div>
                </div>

            </div>

            <div class="row">
                <div class="col-sm-6">
                    <button class="btn waves-effect waves-light" type="submit" name="action">Save
                        <i class="material-icons right">send</i>
                    </button>
                </div>
            </div>
        </form>
    </div>
</div>
@endsection
