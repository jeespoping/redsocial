@extends('layouts.app')

@section('content')
    <div class="mx-5">
        <div class="row">

            {{--            Mostrador de la cancha--}}
            <div class="col">
                <div class="card mb-3">
                    @include( $championship->viewType() )
                    <div class="card-body">
                        <h5 class="card-title">{{ $championship->title }}</h5>
                        <p class="card-text">{!! $championship->body !!}</p>
                    </div>
                </div>
            </div>

            <div class="col">
                <div class="box box-primary">
                    <div class="box-body">
                        <div id='calendar'></div>
                    </div>
                </div>
            </div>

            @if($championship->status === 'inscription')
                @if($sheet == 0)
                    <form action="{{ route('teams.store', $championship) }}" method="POST">
                        @csrf
                        <input type="hidden" name="user_id" value="{{auth()->user()->id}}">
                        <div class="col">
                            <div class="box box-primary">
                                <div class="box-header">
                                    <h1>Inscribir Equipo</h1>
                                </div>
                                <div class="box-body">
                                    <div class="form-group {{ $errors->has('name') ? 'has-error' : '' }}">
                                        <label >Nombre del equipo</label>
                                        <input type="text"
                                               name="name"
                                               value="{{ old('name') }}"
                                               class="form-control"
                                               placeholder="Ingresa aquí el nombre del equipo"
                                        >
                                        {!! $errors->first('name', '<span class="help-block">:message</span>') !!}
                                    </div>
                                    <button type="submit" class="btn btn-primary btn-block">Inscribir equipo</button>
                                </div>
                            </div>
                        </div>
                    </form>
                @else
                    <div class="col">
                        <h1>Ya perteneces a un equipo</h1>
                    </div>
                @endif

            @endif
        <div>
    </div>

    @can('update',$championship)
    <!-- Modal -->
    <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Datos del evento</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form action="#">

                        <input type="hidden" id="txtFecha">
                        <input type="hidden" id="txtid">

                        <div class="box box-primary">
                            <div class="box-body">

                                <div class="form-group">
                                    <label>Titulo del evento</label>
                                    <input id="title" class="form-control" type="text" name="title" required>
                                </div>

                                <div class="form-group">
                                    <label>Descripcion del evento</label>
                                    <textarea id="description" class="form-control" name="description" rows="5"></textarea>
                                </div>

                                <div class="form-group">
                                    <label>Hora</label>
                                    <select name="start" id="start"  class="form-control" style="width: 100%;">
                                        <option value="">Selecciona una opcion</option>
                                    </select>
                                </div>

                            </div>
                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-primary" id="btnAgregar">Agregar</button>
                    <button type="button" class="btn btn-success" id="btnModificar">Modificar</button>
                    <button type="button" class="btn btn-danger" id="btnBorrar">Borrar</button>
                    <button type="button" data-dismiss="modal"  class="btn btn-dark" id="btncancelar">Cancelar</button>
                </div>
            </div>
        </div>
    </div>

    @endcan

@stop

@push('styles')
    <link rel="stylesheet" href="/css/main.css">
    <link rel="stylesheet" href="/adminlte/plugins/select2/select2.min.css">
@endpush

@push('scripts')
    <script src="/adminlte/plugins/select2/select2.full.min.js"></script>
    <script src="/js/main.js"></script>

    <script>

        $(".select2").select2();

        document.addEventListener('DOMContentLoaded', function() {
            var calendarEl = document.getElementById('calendar');

            var calendar = new FullCalendar.Calendar(calendarEl, {

                height: 650,

                headerToolbar: {
                    start: 'prev,next today',
                    center: 'title',
                    end: 'dayGridMonth'
                },

                @can('update',$championship)

                dateClick:function (info){

                    //FUNCION QUE DESACTIVA HORAS YA APARTADA
                    @for($i = 6; $i < 24; $i++)
                    $('#start option[value="{{$i<10?'0'.$i:$i}}:00:00"]').remove();
                    document.getElementById("start").innerHTML += '<option value="{{ $i<10 ? '0'.$i : $i }}:00:00">{{$i}} - {{$i+1}}</option>'
                    @endfor
                    @foreach($championship->court->events as $event)
                    if (info.dateStr == '{{$event->start->format('Y-m-d')}}'){
                        $('#start option[value="{{$event->start->format('H:i:s')}}"]').remove();
                    }
                    @endforeach

                    limpiarFormulario();

                    $('#txtFecha').val(info.dateStr)

                    $('#btnAgregar').prop("disabled",false)
                    $('#btnModificar').prop("disabled",true)
                    $('#btnBorrar').prop("disabled",true)



                    $('#exampleModal').modal('toggle');

                },

                eventClick:function (info){

                    $('#btnAgregar').prop("disabled",true)
                    $('#btnModificar').prop("disabled",false)
                    $('#btnBorrar').prop("disabled",false)

                    hora = info.event.start.getHours()
                    hora = (hora<10)?"0"+hora:hora
                    hora = hora+":00:00";
                    console.log(hora);

                    mes = info.event.start.getMonth()+1;
                    dia = info.event.start.getDate();
                    anio = info.event.start.getFullYear();

                    mes = (mes<10)?"0"+mes:mes;
                    dia = (dia<10)?"0"+dia:dia;

                    convinado = anio+"-"+mes+"-"+dia;

                    //actualizar modal
                    @for($i = 6; $i < 24; $i++)
                    $('#start option[value="{{$i<10?'0'.$i:$i}}:00:00"]').remove();
                    document.getElementById("start").innerHTML += '<option value="{{ $i<10 ? '0'.$i : $i }}:00:00">{{$i}} - {{$i+1}}</option>'
                    @endfor

                    //FUNCION QUE DESACTIVA HORAS YA APARTADA
                    @foreach($championship->court->events as $event)
                    if (convinado == '{{$event->start->format('Y-m-d')}}' && hora != '{{$event->start->format('H:i:s')}}'){
                        $('#start option[value="{{$event->start->format('H:i:s')}}"]').remove();
                    }
                    @endforeach

                    $('#txtid').val(info.event.id);
                    $('#txtFecha').val(anio+"-"+mes+"-"+dia);
                    $('#title').val(info.event.title);
                    $('#description').val(info.event.extendedProps.description);
                    $('#start').val(hora);

                    $('#exampleModal').modal('toggle');
                },

                @endcan

                events: "/events/{{ $championship->court->url }}/show",

                themeSystem: 'bootstrap',

                initialView: 'dayGridMonth',

            });

            calendar.setOption('locale', 'Es'); //poner calendario en español

            calendar.render(); //renderizado

            @can('update',$championship)
            selectable: true;

            $('#btnAgregar').click(function (){
                objEvento = recolectarDatosGui("POST");
                Enviarinformacion("/championship",objEvento);
            });

            $('#btnBorrar').click(function (){
                objEvento = recolectarDatosGui("DELETE");
                Enviarinformacion("/"+$('#txtid').val(),objEvento);
            });

            $('#btnModificar').click(function (){
                objEvento = recolectarDatosGui("PUT");
                Enviarinformacion("/"+$('#txtid').val(),objEvento);
            });

            function recolectarDatosGui(method){

                nuevoEvento={
                    title: $('#title').val(),
                    description: $('#description').val(),
                    start: $('#start').val() + " " + $('#txtFecha').val(),

                    '_token': '{{ csrf_token() }}',
                    '_method':method
                }
                return (nuevoEvento);
            }

            function Enviarinformacion(accion,objEvento){
                $.ajax({
                    type: 'POST',
                    url:'/events/{{ $championship->court->url }}'+accion,
                    data: objEvento,
                    success: function (msg){

                        $('#exampleModal').modal('toggle');

                        calendar.refetchEvents();

                    },
                }).fail(function (jqXHR, textStatus, errorThrown){
                    if (jqXHR.status === 500){
                        alert("No estas autorizado para hacer algun cambio en este evento");
                    }else if (jqXHR.status === 422){
                        alert("Faltan datos por ingresar");
                    }
                    else {
                        alert("Error");
                    }
                });
            }

            function limpiarFormulario(){
                $('#txtid').val("");
                $('#title').val("");
                $('#description').val("");
                $('#start').val('');
            }

            @endcan
        });

    </script>
@endpush