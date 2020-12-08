@extends('admin.layout')

@section('content')
    <div class="row">
        <div class="col-md-6">
            <div class="box box-primary">
                <div class="box-header with-border">
                    <h3 class="box-title">Titulo del campeonato</h3>
                </div>
                <div class="box-body">
                    <form action="{{route('admin.championships.store')}}" method="post">
                        @csrf
                        <div class="form-group">
                            <label for="title">Titulo del campeonato</label>
                            <input id="championship-title" name="title"
                                   class="form-control"
                                   value="{{ old('title') }}"
                                   placeholder="Ingresa aquí el título del campeonato" autofocus required>
                            {!! $errors->first('title', '<span class="help-block">:message</span>') !!}
                        </div>

                        <button class="btn btn-primary btn-block">Crear Campeonato</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
@stop
