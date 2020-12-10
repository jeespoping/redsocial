@extends('layouts.app')

@section('content')

    @if($team->championship->status === 'inscription')
        <div class="mx-5">
            <div class="row">

                @if($team->user_id === auth()->user()->id)
                <div class="col">
                    <div class="box box-primary">
                        <div class="box-header">
                            <div class="box-title">
                                Seleccion de jugadores en tu equipo
                            </div>
                        </div>
                        <div class="box-body">
                            <form action="{{ route('sheets.store', $team) }}" method="post">
                                @csrf
                                <div class="form-group">
                                    <select name="user_id[]" multiple="multiple" id="sheet" class="form-control select2" data-placehholder="selecciona uno o mas amigos" style="width: 100%;">
                                        @foreach(auth()->user()->friends() as $friend)
                                            @if(\App\Sheet::all()->where('user_id',$friend->id)->count() == 0)
                                                <option value="{{ $friend->id }}">{{ $friend->name }}</option>
                                            @endif
                                        @endforeach
                                    </select>
                                    {!! $errors->first('user_id', '<span class="help-block">:message</span>') !!}
                                </div>
                                <button class="btn btn-primary btn-block" type="submit">Registrar jugadores</button>
                            </form>
                        </div>
                    </div>
                </div>
                @endif

                <div class="col">
                    <div class="box box-primary">
                        <div class="box-header">
                            <h3 class="box-title">Listado de jugadores</h3>
                        </div>
                        <div class="box-body">
                            <table id="teams-table" class="table table-bordered table-striped">
                                <thead>
                                    <tr>
                                        <th>Nombre de usuario</th>
                                        <th>Primer nombre</th>
                                        <th>Apellido</th>
                                        <th>Email</th>
                                        <th>Acciones</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($team->sheets()->with('owner')->get() as $sheet)
                                        <tr>
                                            <td>{{$sheet->owner()->first()->name}}</td>
                                            <td>{{$sheet->owner()->first()->first_name}}</td>
                                            <td>{{$sheet->owner()->first()->last_name}}</td>
                                            <td>{{$sheet->owner()->first()->email}}</td>
                                            <td>
                                                @if(auth()->user()->id === $sheet->user_id || auth()->user()->id === $team->user_id)
                                                    <form action="{{ route('sheets.destroy', ['sheet' => $sheet, 'team' => $team]) }}" method="post" style="display: inline">
                                                        @csrf @method('DELETE')
                                                        <button class="btn btn-xs btn-danger" onclick="return confirm('Estas seguro de querer eliminar este jugador?')">
                                                            <i class="fa fa-times"></i>
                                                        </button>
                                                    </form>
                                                @endif
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    @endif

@stop

@push('styles')
    <link rel="stylesheet" href="/adminlte/plugins/select2/select2.min.css">
@endpush

@push('scripts')
    <script src="/adminlte/plugins/select2/select2.full.min.js"></script>
    <script>

        $('.select2').select2({
            tags: true
        });

    </script>

@endpush