@extends('admin.layout')

@section('header')
    <h1>
        Canchas
        <smal>Listado</smal>
    </h1>
    <ol class="breadcrumb">
        <li><a href="{{ route('dashboard') }}"><i class="fa fa-dashboard"></i>Inicio</a></li>
    </ol>
@stop

@section('content')
    <div class="box box-primary">
        <div class="box-header">
            <h3 class="box-title">Listado de Canchas</h3>
            <button class="btn btn-primary pull-right" data-toggle="modal" data-target="#myModal">
                <i class="fa fa-plus"></i> Crear cancha
            </button>
        </div>
        {{--    box-header--}}
        <div class="box-body">
            <table id="courts-table" class="table table-bordered table-striped">
                <thead>
                <tr>
                    <th>ID</th>
                    <th>Titulo</th>
                    <th>Acciones</th>
                </tr>
                </thead>
                <tbody>
                @foreach($courts as $court)
                    <tr>
                        <td>{{ $court->id }}</td>
                        <td>{{ $court->title }}</td>
                        <td>
                            <a href="#"
                               class="btn btn-xs btn-default"
                               target="_blank"
                            ><i class="fa fa-eye"></i></a>
{{--                             Editar Canchas--}}
                            <a href="{{ route('admin.courts.edit', $court) }}" class="btn btn-xs btn-info">
                                <i class="fa fa-pencil"></i>
                            </a>

{{--                            Eliminar canchas--}}
                            <form action="{{ route('admin.courts.destroy', $court) }}" method="post" style="display: inline">
                                @csrf @method('DELETE')
                                <button
                                        class="btn btn-xs btn-danger"
                                        onclick="return confirm('Estas seguro de querer eliminar esta cancha?')"
                                ><i class="fa fa-times"></i></button>
                            </form>
                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        </div>
    </div>



@stop

@push('styles')
    <link rel="stylesheet" href="/adminlte/plugins/datatables/dataTables.bootstrap.css">
@endpush

@push('scripts')
    <script src="/adminlte/plugins/datatables/jquery.dataTables.min.js"></script>
    <script src="/adminlte/plugins/datatables/dataTables.bootstrap.min.js"></script>
    <script>
        $(function () {
            $("#courts-table").DataTable();
        });
    </script>
@endpush

