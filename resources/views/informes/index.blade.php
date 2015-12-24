@extends('layouts.layouts')
@section('title')
Informes Semanales
@stop

@section('title-form')
Lista Informes Semanales
@stop

@section('content')
    <div class="panel panel-body">
<div class="btn btn-info"><a href="{{route('create-record')}}"  class="button radius">Nuevo Informe</a></div>
<table class="table table-bordered">
    <thead>
        <tr> 
            <th>Nº</th>
            <th width="200">Numero</th> 
            <th width="150">Lineas</th>
            <th width="150">Sábado</th>
            <th width="150">Monto</th>
            <th width="50">Editar</th> 
            <th width="50">Eliminar</th> 
        </tr>
    </thead> 
    <tbody> 
        @foreach($informes AS $key=>$informe)
        <tr>
            <td>{{$key+1}}</td>
            <td>{{$informe->numbers}}</td>
            <td>{{$informe->controlNumber}}</td>
            <td>{{$informe->saturday}}</td>
            <td>{{number_format($informe->balance,2)}}</td>
            <td></td>
            <td></td>
        </tr>
        @endforeach
    </tbody>
</table>
   <div class="pull-right"> {!! $informes->render()!!}</div>
    </div>
@stop