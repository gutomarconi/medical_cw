<?php
/**
 * Created by PhpStorm.
 * User: Gustavo
 * Date: 28/03/2019
 * Time: 08:57
 */
?>
@extends('layouts.app')

@section('content')

    <div class="container">
        <div class="content">
            <div class="row">
                <div class="col s12 m6">
                    <div class="card white">
                        <div class="card-content black-text">
                            <span class="card-title">Cannot Delete</span>
                            <p>{{$error}}</p>
                        </div>
                        <div class="card-action">
                            <a href="{{route('Peoples.index')}}">Back to Patients List</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
