@extends('layouts.app')

@section('content')
    <div class="mx-5">
        <div class="row">

{{--            Mostrador de la cancha--}}
            <div class="col">
                <div class="card mb-3">
                    @include( $court->viewType() )
                    <div class="card-body">
                        <h5 class="card-title">{{ $court->title }}</h5>
                        <h4 class="card-subtitle mb-2 text-muted text-primary">$ {{ $court->cost === 0 ? 'Gratis' : $court->cost }}</h4>
                        <p class="card-text">{!! $court->body !!}</p>
                    </div>
                </div>
            </div>


            <div class="col-md-8">
                <div class="box box-primary">
                    <div class="box-body">
                        <div id='calendar'></div>
                    </div>
                </div>
            </div>
        <div>
    </div>
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
                                        <option value="6:00:00">6-7</option>
                                        <option value="7:00:00">7-8</option>
                                        <option value="8:00:00">8-9</option>
                                        <option value="9:00:00">9-10</option>
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

                dateClick:function (info){

                    limpiarFormulario();

                    $('#txtFecha').val(info.dateStr)

                    $('#btnAgregar').prop("disabled",false)
                    $('#btnModificar').prop("disabled",true)
                    $('#btnBorrar').prop("disabled",true)

                    $('#exampleModal').modal('toggle');
                    // calendar.addEvent({ title:"Evento x", date:info.dateStr, descripcion: "Partido amistoso"});
                }, //crea un evento con un click

                eventClick:function (info){

                    $('#btnAgregar').prop("disabled",true)
                    $('#btnModificar').prop("disabled",false)
                    $('#btnBorrar').prop("disabled",false)

                    hora = info.event.start.getHours()+":00:00";

                    mes = info.event.start.getMonth()+1;
                    dia = info.event.start.getDate();
                    anio = info.event.start.getFullYear();

                    mes = (mes<10)?"0"+mes:mes;
                    dia = (dia<10)?"0"+dia:dia;

                    $('#txtid').val(info.event.id);
                    $('#txtFecha').val(anio+"-"+mes+"-"+dia);
                    $('#title').val(info.event.title);
                    $('#description').val(info.event.extendedProps.description);
                    $('#start').val(hora);

                    $('#exampleModal').modal('toggle');
                },

                events:[
                    {
                        title: 'Birthday Party',
                        start: '2020-12-13T07:00:00',
                        backgroundColor: 'green',
                        borderColor: 'green'
                    }
                ],

                events: "/events/{{ $court->url }}/show",


                selectable: true,
                themeSystem: 'bootstrap',

                initialView: 'dayGridMonth',

            });

            calendar.setOption('locale', 'Es'); //poner calendario en español

            calendar.render(); //renderizado

            $('#btnAgregar').click(function (){
               objEvento = recolectarDatosGui("POST");
               Enviarinformacion("",objEvento);
            });

            $('#btnBorrar').click(function (){
                objEvento = recolectarDatosGui("DELETE");
                Enviarinformacion("/"+$('#txtid').val(),objEvento);
            });

            $('#btnModificar').click(function (){
                objEvento = recolectarDatosGui("PATCH");
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
                    url:'/events/{{ $court->url }}'+accion,
                    data: objEvento,
                    success: function (msg){
                        console.log(msg);

                        $('#exampleModal').modal('toggle');

                        calendar.refetchEvents();
                        },
                    error: function (){alert("Hay un error");},
                });
            }

            function limpiarFormulario(){
                $('#txtid').val("");
                $('#title').val("");
                $('#description').val("");
                $('#start').val('');
            }

        });

    </script>
@endpush