@extends('admin.layout')

@section('header')
    <h1>
        Canchas
        <small>Crear canchas</small>
    </h1>
    <ol class="breadcrumb">
        <li><a href="{{ route('dashboard') }}"><i class="fa fa-dashboard"></i> Inicio</a></li>
        <li><a href="{{ route('admin.courts.index') }}"><i class="fa fa-list"></i> Canchas</a></li>
        <li class="active">Crear</li>
    </ol>
@stop

@section('content')

    <div class="row">
        @if($court->photos->count())
            <div class="col-md-12">
                <div class="box box-primary">
                    <div class="box-body">
                        @foreach($court->photos as $photo)
                            <form action="{{ route('admin.photos.destroy', $photo) }}" method="post">
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
        <form action="{{ route('admin.courts.update', $court) }}" method="post" id="post-form">
            @csrf @method('PUT')
            <div class="col-md-8">
                <div class="box box-primary">
                    <div class="box-body">
                        <div class="form-group {{ $errors->has('title') ? 'has-error' : '' }}">
                            <label>Nombre de la cancha</label>
                            <input name="title"
                                   class="form-control"
                                   value="{{ old('title', $court->title) }}"
                                   placeholder="Ingresa aquí el título de la publicación">
                            {!! $errors->first('title', '<span class="help-block">:message</span>') !!}
                        </div>
                        <div class="form-group {{ $errors->has('body') ? 'has-error' : '' }}">
                            <label>Contenido de la publicacion de la cancha</label>
                            <textarea
                                    name="body"
                                    id="editor"
                                    rows="10"
                                    placeholder="Ingresa el contenido completo de tu cancha"
                                    class="form-control">
                                {{ old('body', $court->body) }}
                            </textarea>
                            {!! $errors->first('body', '<span class="help-block">:message</span>') !!}
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="box box-primary">
                    <div class="box-body">
                        <div class="form-group {{ $errors->has('category_id') ? 'has-error' : ''}}">
                            <label>Categorias</label>
                            <select name="category_id" class="form-control select2">
                                <option value="">Selecciona una categoria</option>
                                @foreach($categories as $category)
                                    <option value="{{ $category->id }}"
                                            {{ old('category_id', $court->category_id) == $category->id ? 'selected' : '' }}
                                    >{{ $category->name }}</option>
                                @endforeach
                            </select>
                            {!! $errors->first('category_id', '<span class="help-block">:message</span>') !!}
                        </div>
                        <div class="form-group {{ $errors->has('cost') ? 'has-error' : ''}}">
                            <label>Precio por hora</label>
                            <div class="input-group">
                                <span class="input-group-addon">$</span>
                                <input type="number"
                                       name="cost"
                                       class="form-control"
                                       value="{{ old('cost', $court->cost) }}"
                                       placeholder="Ingresa el precio por hora">
                                {!! $errors->first('cost', '<span class="help-block">:message</span>') !!}
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="dropzone"></div>
                        </div>
                        <div class="form-group">
                            <button type="submit" class="btn btn-primary btn-block">Guardar Cancha</button>
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
            url: '/admin/courts/{{ $court->url }}/photos',
            paramName: 'photo',
            acceptedFiles: 'image/*',
            maxFilesize: 2,
            headers: {
                'X-CSRF-TOKEN': '{{ csrf_token() }}'
            },
            dictDefaultMessage: 'Arrastra las fotos aquí para subirlas'
        });

        myDropzone.on('error', function(file, res){
            var msg = res.photo[0];
            $('.dz-error-message:last > span').text(msg);
        });

        Dropzone.autoDiscover = false;

    </script>
@endpush