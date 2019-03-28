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

            <div class="header">
                <h5>Appointments</h5>
            </div>
            <div id="custom-toolbar-appointments">
                <a class="btn btn-primary btn-circle-lg " id="btn_create" href={{route('Medrecords.create',$people_id)}}><i class="material-icons">add</i></a>
            </div>


            <table class="highlight">
                <thead>
                <td>Date</td>
                <td>Note</td>
                <td>Actions</td>
                </thead>
                <tbody>

                @foreach ($allRecords as $records)
                    @if ($records->status != "C")
                    <tr>
                        <td class="inner-table">{{ date('d/m/Y', strtotime($records->date_appointment))}}</td>
                        <td class="inner-table">{{ $records->notes}}</td>
                        <td>
                            <a href="{{route('Medrecords.edit', array('people_id' => $people_id, 'medrecords_id' => $records->id))}}" name="btn_editPatient" id="btn_editPatient" class="btn btn-info" data-toggle="tooltip" title="Edit"><i class="material-icons">edit</i></a>
                        </td>
                        <td>
                            <form action="{{route('Medrecords.cancel', array('medrecords_id' => $records->id, 'status' => 'C'))}}" method="PUT">
                                @csrf
                                <button name="btn_cancelAppointment" class="btn btn-danger" type="submit" data-toggle="tooltip" title="Cancel">
                                    <i class="material-icons">cancel</i>
                                </button>
                            </form>
                        </td>
                    </tr>
                    @endif
                @endforeach
                </tbody>
            </table>
        </div>
    </div>
@endsection
