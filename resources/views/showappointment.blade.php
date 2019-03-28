<?php
/**
 * Created by PhpStorm.
 * User: Gustavo
 * Date: 27/03/2019
 * Time: 12:25
 */
?>
@extends('layouts.app')
@section('content')

    <div class="container">
        <div class="content">
            <div class="row">
                <div class="col s6">
                    <h5> Appointment</h5>
                </div>
            </div>
            <div class="row">
                <div class="col s6">
                    <a class="btn btn-primary btn-circle-lg " id="btn_medicalRecords" href="{{route('Medrecords.edit',$medrecords->id)}}"><i class="material-icons">edit</i></a>
                </div>
            </div>
            <div class="row">
                <div class="input-field col s4">
                    <input disabled id="name" type="text" class="validate" name="name" value={{$medrecords->date_appointment}}>
                    <label for="name">Date Appointment</label>
                </div>
            </div>

            <div class="row">
                <div class="form-group">
                    <label for="Notes">Notes</label>
                    <textarea class="form-control" id="Notes" rows="3" name="notes" value={{$medrecords->notes}}></textarea>
                </div>
            </div>
        </div>
    </div>
@endsection
