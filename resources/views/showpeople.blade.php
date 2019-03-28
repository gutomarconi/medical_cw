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
        <div class="row">
            <div class="col s6">
                <h5> Patient</h5>
            </div>
        </div>
        <div class="row">
            <div class="col s6">
                <a class="btn btn-primary btn-circle-lg " id="btn_createPatient" href="{{route('Peoples.edit',$people->id)}}"><i class="material-icons">edit</i></a>
            </div>
        </div>
        <div class="row">
            <div class="input-field col s4">
                <input disabled id="name" type="text" class="validate" name="name" value={{$people->name}}>
                <label for="name">Full Name</label>
            </div>

            <div class="input-field col s6" >
                <input disabled id="email" type="text" class="validate" name="email" value={{$people->email}}>
                <label for="email">Email</label>
            </div>
        </div>

        <div class="row">
            <div class="input-field col s12">
                <input disabled id="height" dataformatas="#.##" type="number" class="validate" name="height" value={{$people->height}}>
                <label for="height">Height</label>
            </div>

            <div class="input-field col s12">
                <input disabled class="validate" dataformatas="###.##" id="weight" name="weight" type="number" value={{$people->weight}}>
                <label for="weight">Weight</label>
            </div>
        </div>

        <div class="row">
            <div class="input-field col s12">
                <input disabled id="date_of_birth" type="date" class="validate" name="date_of_birth" value={{ date('d/m/Y', strtotime($people->date_of_birth))}}>
                <label for="date_of_birth">Date of Birth</label>
            </div>

            <div class="input-field col s12">
                <input disabled id="phone_number" type="text" class="validate" name="phone_number" value={{$people->phone_number}}>
                <label for="phone_number">Phone Number</label>
            </div>
        </div>
    </div>
</div>
@endsection
