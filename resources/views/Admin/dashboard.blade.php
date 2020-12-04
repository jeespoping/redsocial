@extends('admin.layout')

@section('content')
    <h1>Inicio</h1>
    <p>Administrador: {{ auth()->user()->name }}</p>
@stop
