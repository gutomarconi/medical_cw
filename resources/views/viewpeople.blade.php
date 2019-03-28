<?php
/**
 * Created by PhpStorm.
 * User: Gustavo
 * Date: 22/03/2019
 * Time: 19:10
 */
?>
@extends('layouts.app')

@section('content')

    <div class="container">
        <div class="content">
            <h4>List of Peoples</h4>

            <a class="btn btn-primary btn-circle-lg " id="btn_createPatient" href="{{route('Peoples.create')}}"><i class="material-icons">add</i></a>
            <table class="highlight">
                <thead>
                <td>Name</td>
                <td>email</td>
                <td>Date Of Birth</td>
                <td>Phone Number</td>
                <td>Height</td>
                <td>Weight</td>
                </thead>
                <tbody>
                @foreach ($allPeoples as $peoples)
                    <tr>
                        <td class="inner-table">
                            <a href="{{route('Medrecords.get',$peoples->id)}}">{{ $peoples->name }}</a>
                        </td>
                        <td class="inner-table">{{ $peoples->email}}</td>
                        <td class="inner-table">{{ date('d/m/Y', strtotime($peoples->date_of_birth))}}</td>
                        <td class="inner-table">{{ $peoples->phone_number}}</td>
                        <td class="inner-table">{{ $peoples->height }}</td>
                        <td class="inner-table">{{ $peoples->weight}}</td>
                        <td>
                            <a href="{{route('Peoples.edit', $peoples->id)}}" name="btn_editPatient" id="btn_editPatient" class="btn btn-info" ><i class="material-icons">edit</i></a>
                        </td>
                        <td>
                            <form action="{{route('Peoples.destroy', $peoples->id)}}" method="POST">
                                {!! method_field('delete') !!}
                                @csrf
                                <button name="btn_destroyPatient" class="btn btn-danger" type="submit"><i class="material-icons">delete</i></button>
                            </form>
                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        </div>
    </div>
@endsection
