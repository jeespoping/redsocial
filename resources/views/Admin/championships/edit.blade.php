@extends('admin.layout')

@section('header')
    <h1>
        Campeonatos
        <small>Crear Campeonatos</small>
    </h1>
    <ol class="breadcrumb">
        <li><a href="{{ route('dashboard') }}"><i class="fa fa-dashboard"></i> Inicio</a></li>
        <li><a href="{{ route('admin.championships.index') }}"><i class="fa fa-list"></i> Campeonatos</a></li>
        <li class="active">Crear</li>
    </ol>
@stop

@section('content')

    <div class="row">
        @if($championship->photoos->count())
            <div class="col-md-12">
                <div class="box box-primary">
                    <div class="box-body">
                        @foreach($championship->photoos as $photo)
                            <form action="{{ route('admin.photoos.destroy', $photo) }}" method="post">
                                @method('DELETE') @csrf
                                <div class="col-md-2">
                                    <button class="btn btn-danger btn-xs" style="...">
                                        <i class="fa fa-remove"></i>
                                    </button>
                                    <img src="{{ url('storage/'.$photo->url) }}" class="img-responsive" alt="Error">
                                </div>
                            </form>
                        @endforeach
                    </div>
                </div>
            </div>
        @endif

        <form action="{{ route('admin.championships.update', $championship) }}" method="post" id="post-form">
            @csrf @method('PATCH')
            <div class="col-md-8">
                <div class="box box-primary">
                    <div class="box-body">
                        <div class="form-group {{ $errors->has('title') ? 'has-error' : '' }}">
                            <label>Nombre del campeonato</label>
                            <input name="title"
                                   class="form-control"
                                   value="{{ old('title', $championship->title) }}"
                                   placeholder="Ingresa aquí el título del campeonato">
                            {!! $errors->first('title', '<span class="help-block">:message</span>') !!}
                        </div>
                        <div class="form-group {{ $errors->has('body') ? 'has-error' : '' }}">
                            <label>Descripcion del campeonato</label>
                            <textarea
                                    name="body"
                                    id="editor"
                                    rows="10"
                                    placeholder="Ingresa una descripcion del campeonato"
                                    class="form-control">
                                {{ old('body', $championship->body) }}
                            </textarea>
                            {!! $errors->first('body', '<span class="help-block">:message</span>') !!}
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="box box-primary">
                    <div class="box-body">
                        <div class="form-group {{ $errors->has('court_id') ? 'has-error' : ''}}">
                            <label>Canchas</label>
                            <select name="court_id" class="form-control select2">
                                <option value="">Selecciona una Cancha</option>
                                @foreach($courts as $court)
                                    <option value="{{ $court->id }}"
                                            {{ old('court_id', $championship->court_id) == $court->id ? 'selected' : '' }}
                                    >{{ $court->title }}</option>
                                @endforeach
                            </select>
                            {!! $errors->first('category_id', '<span class="help-block">:message</span>') !!}
                        </div>

                        <div class="form-group">
                            <div class="dropzone"></div>
                        </div>
                        <div class="form-group">
                            <button type="submit" class="btn btn-primary btn-block">Guardar Campeonato</button>
                        </div>
                    </div>
                </div>
            </div>
        </form>
    </div>
@stop

@push('styles')
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/dropzone/5.0.1/dropzone.css">
    <link rel="stylesheet" href="/adminlte/plugins/select2/select2.min.css">
@endpush

@push('scripts')
    <script src="https://cdnjs.cloudflare.com/ajax/libs/dropzone/5.0.1/min/dropzone.min.js"></script>
    <script src="/adminlte/plugins/select2/select2.full.min.js"></script>
    <script src="https://cdn.ckeditor.com/4.6.2/standard/ckeditor.js"></script>
    <script>

        CKEDITOR.replace('editor');
        CKEDITOR.config.height = 315;

        $('.select2').select2({
            tags: true
        });

        var myDropzone = new Dropzone('.dropzone', {
            url: '/admin/championships/{{ $championship->url }}/photoos',
            paramName: 'photoo',
            acceptedFiles: 'image/*',
            maxFilesize: 2,
            headers: {
                'X-CSRF-TOKEN': '{{ csrf_token() }}'
            },
            dictDefaultMessage: 'Arrastra las fotos aquí para subirlas'
        });

        myDropzone.on('error', function(file, res){
            var msg = res.photoo[0];
            $('.dz-error-message:last > span').text(msg);
        });

        Dropzone.autoDiscover = false;

    </script>
@endpush