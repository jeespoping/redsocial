@extends('admin.layout')

@section('header')
    <h1>
        Estadisticas de {{ $team->name }}
        <small>Insertar datos</small>
    </h1>
    <ol class="breadcrumb">
        <li><a href="{{ route('dashboard') }}"><i class="fa fa-dashboard"></i> Inicio</a></li>
        <li class="active">Crear</li>
    </ol>
@stop

@section('content')
    <div class="row">
        <form action="{{ route('admin.statistics.update', ['championship' => $championship, 'team' => $team]) }}" method="post" id="post-form">
            @csrf @method('PUT')
            <div class="col-md-8">
                <div class="box box-primary">
                    <div class="box-body">
                        <div class="form-group {{ $errors->has('rp') ? 'has-error' : '' }}">
                            <label>Numero de remates a puerta</label>
                            <input name="rp"
                                   type="number"
                                   class="form-control"
                                   value="{{ old('rp', $team->statistic()->first()->rp ) }}"
                                   placeholder="Ingresa aquí el numero de remates a puertas">
                            {!! $errors->first('rp', '<span class="help-block">:message</span>') !!}
                        </div>
                        <div class="form-group {{ $errors->has('goles') ? 'has-error' : '' }}">
                            <label>Numero de goles</label>
                            <input name="goles"
                                   type="number"
                                   class="form-control"
                                   value="{{ old('goles', $team->statistic()->first()->goles ) }}"
                                   placeholder="Ingresa aquí el numero de goles">
                            {!! $errors->first('goles', '<span class="help-block">:message</span>') !!}
                        </div>
                        <div class="form-group {{ $errors->has('ganados') ? 'has-error' : '' }}">
                            <label>Numero de partidos ganados</label>
                            <input name="ganados"
                                   type="number"
                                   class="form-control"
                                   value="{{ old('ganados', $team->statistic()->first()->ganados ) }}"
                                   placeholder="Ingresa aquí el numero de partidos ganados">
                            {!! $errors->first('ganados', '<span class="help-block">:message</span>') !!}
                        </div>
                        <div class="form-group {{ $errors->has('perdidos') ? 'has-error' : '' }}">
                            <label>Numero de partidos perdidos</label>
                            <input name="perdidos"
                                   type="number"
                                   class="form-control"
                                   value="{{ old('eprdidos', $team->statistic()->first()->perdidos ) }}"
                                   placeholder="Ingresa aquí el numero de partidos Perdidos">
                            {!! $errors->first('perdidos', '<span class="help-block">:message</span>') !!}
                        </div>
                        <div class="form-group {{ $errors->has('faltas') ? 'has-error' : '' }}">
                            <label>Numero de faltas cometidas</label>
                            <input name="faltas"
                                   type="number"
                                   class="form-control"
                                   value="{{ old('faltas', $team->statistic()->first()->faltas ) }}"
                                   placeholder="Ingresa aquí el numero de faltas">
                            {!! $errors->first('faltas', '<span class="help-block">:message</span>') !!}
                        </div>
                        <div class="form-group {{ $errors->has('tr') ? 'has-error' : '' }}">
                            <label>Numero de tajetas rojas</label>
                            <input name="tr"
                                   type="number"
                                   class="form-control"
                                   value="{{ old('tr', $team->statistic()->first()->tr ) }}"
                                   placeholder="Ingresa aquí el numero de tarjetas rojas">
                            {!! $errors->first('tr', '<span class="help-block">:message</span>') !!}
                        </div>
                        <div class="form-group {{ $errors->has('ta') ? 'has-error' : '' }}">
                            <label>Numero de tajetas amarillas</label>
                            <input name="ta"
                                   type="number"
                                   class="form-control"
                                   value="{{ old('ta', $team->statistic()->first()->ta ) }}"
                                   placeholder="Ingresa aquí el numero de tarjetas amarillas">
                            {!! $errors->first('ta', '<span class="help-block">:message</span>') !!}
                        </div>
                        <button type="submit" class="btn btn-primary btn-block">Actualizar datos</button>
                    </div>
                </div>
            </div>
        </form>
    </div>
@stop