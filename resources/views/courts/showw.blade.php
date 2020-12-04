@extends('layouts.app')

@section('content')
    <div class="mx-5">
        <div class="row">
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
                        <div class="form-group">
                            <label> <strong>Titulo del Partido</strong></label>
                            <input type="text" class="form-control" name="title" placeholder="Ingrese el titulo del partido">
                        </div>
                        <div class="form-group">
                            <label> <strong>Fecha del partido</strong></label>
                            <div class="input-group date">
                                <div class="input-group-addon">
                                    <i class="fa fa-calendar"></i>
                                </div>
                                <input name="published_at"
                                       class="form-control pull-right"
{{--                                       value="{{ old('published_at', $post->published_at ? $post->published_at->format('m/d/Y') : null) }}"--}}
                                       type="text"
                                       id="datepicker"
                                       autocomplete="off">
                            </div>
                        </div>
                        <div class="row">
                            <div class="col">
                                <div class="form-group">
                                    <div class="form-group">
                                        <label>Hora del partido</label>
                                        <select class="form-control select2" multiple="multiple" data-placeholder="Selecciona una o varias horas" style="width: 100%;">
                                            <option>6-7</option>
                                            <option>7-8</option>
                                            <option>8-9</option>
                                            <option>9-10</option>
                                            <option>15-16</option>
                                            <option>16-17</option>
                                            <option>17-18</option>
                                            <option>18-19</option>
                                            <option>19-20</option>
                                            <option>20-21</option>
                                            <option>21-22</option>
                                            <option>22-23</option>
                                        </select>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        <div>
    </div>
@stop

@push('styles')
    <link rel="stylesheet" href="/adminlte/plugins/datepicker/datepicker3.css">
    <link rel="stylesheet" href="/adminlte/plugins/select2/select2.min.css">
@endpush

@push('scripts')
    <script src="/adminlte/plugins/datepicker/bootstrap-datepicker.js"></script>
    <script src="/adminlte/plugins/select2/select2.full.min.js"></script>
    <script>
        $('#datepicker').datepicker({
            autoclose: true
        });

        $(".select2").select2();

    </script>
@endpush