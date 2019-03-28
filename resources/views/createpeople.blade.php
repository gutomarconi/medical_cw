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
            @if(empty($people))
                <form method="POST" action={{ route('Peoples.store') }}>
                    <h5> New Patient</h5>
            @else
                <form method="POST" action={{ route('Peoples.update', $people->id) }}>
                    <h5> Edit Patient</h5>
                    {{ method_field('PUT') }}
            @endif
                @csrf
                <br>
                    <div class="row">
                        <div class="input-field col s4">
                            @if(empty($people))
                                <input placeholder="John Smith" id="name" type="text" class="validate" name="name">
                            @else
                                <input placeholder="John Smith" id="name" type="text" class="validate" name="name" value={{$people->name}}>
                             @endif
                            <label for="name">Full Name</label>
                        </div>

                        <div class="input-field col s6" >
                            @if(empty($people))
                                <input placeholder="john@domain.co" id="email" type="text" class="validate" name="email">
                            @else
                                <input placeholder="john@domain.co" id="email" type="text" class="validate" name="email" value={{$people->email}}>
                            @endif
                            <label for="email">Email</label>
                        </div>
                    </div>

                    <div class="row">
                        <div class="input-field col s12">
                            @if(empty($people))
                                <input placeholder="Height" id="height" type="number" class="validate" name="height">
                            @else
                                <input placeholder="Height" id="height" type="number" class="validate" name="height" value={{$people->height}}>
                            @endif
                            <label for="height">Height</label>
                        </div>

                        <div class="input-field col s12">
                            @if(empty($people))
                                <input class="validate" id="weight" name="weight" placeholder="weight" type="number">
                            @else
                                <input class="validate" id="weight" name="weight" placeholder="weight" type="number" value={{$people->weight}}>
                            @endif
                            <label for="weight">Weight</label>
                        </div>
                    </div>

                    <div class="row">
                        <div class="input-field col s12">
                            @if(empty($people))
                                <input placeholder="01/01/1980" id="date_of_birth" type="date" class="validate" name="date_of_birth">
                            @else
                                <input class="validate" type="text" name="date_of_birth" value="{{ date('d/m/Y', strtotime($people->date_of_birth))}}">
                            @endif
                            <label for="date_of_birth">Date of Birth</label>
                        </div>

                        <div class="input-field col s12">
                            @if(empty($people))
                                <input placeholder="+44 01234 567 891" id="phone_number" type="text" class="validate" name="phone_number">
                            @else
                                <input placeholder="+44 01234 567 891" id="phone_number" type="text" class="validate" name="phone_number" value={{$people->phone_number}}>
                            @endif
                            <label for="phone_number">Phone Number</label>
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
            </form>
        </div>
    </div>
@endsection
