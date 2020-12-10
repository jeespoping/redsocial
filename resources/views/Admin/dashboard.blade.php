@extends('admin.layout')

@section('content')
    <h1>Inicio</h1>
    <p>Administrador: {{ auth()->user()->name }}</p>

    @if($teams->count() > 0)
        <div class="row">
            <div class="col-md-6">
                <div class="box box-primary">
                    <div class="box-header with-border">
                        <h3 class="box-title">Remates a puertas</h3>

                        <div class="box-tools pull-right">
                            <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
                            </button>
                        </div>
                    </div>
                    <div class="box-body">
                        <div class="chart">
                            <canvas id="barChart" style="height:230px"></canvas>
                        </div>
                    </div>
                </div>
                <div class="box box-primary">
                    <div class="box-header with-border">
                        <h3 class="box-title">Partidos ganados y perdidos</h3>

                        <div class="box-tools pull-right">
                            <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
                            </button>
                        </div>
                    </div>
                    <div class="box-body">
                        <div class="chart">
                            <canvas id="barChart3" style="height:230px"></canvas>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-md-6">
                <div class="box box-primary">
                    <div class="box-header with-border">
                        <h3 class="box-title">Goles</h3>

                        <div class="box-tools pull-right">
                            <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
                            </button>
                        </div>
                    </div>
                    <div class="box-body">
                        <div class="chart">
                            <canvas id="barChart2" style="height:230px"></canvas>
                        </div>
                    </div>
                </div>
                <div class="box box-primary">
                    <div class="box-header with-border">
                        <h3 class="box-title">Tarjetas Rojas y Amarillas</h3>

                        <div class="box-tools pull-right">
                            <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
                            </button>
                        </div>
                    </div>
                    <div class="box-body">
                        <div class="chart">
                            <canvas id="barChart4" style="height:230px"></canvas>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    @endif
@stop


@push('scripts')
    @if($teams->count() > 0)
    <script src="adminlte/plugins/chartjs/Chart.js"></script>
    <script>

        $(function (){

            var areaChartData = {
                labels: [
                    @foreach($teams->get() as $team)
                        "{{$team->name}}",
                    @endforeach
                ],
                datasets: [
                    {
                        label: "Electronics",
                        fillColor: "rgba(210, 214, 222, 1)",
                        strokeColor: "rgba(210, 214, 222, 1)",
                        pointColor: "rgba(210, 214, 222, 1)",
                        pointStrokeColor: "#c1c7d1",
                        pointHighlightFill: "#fff",
                        pointHighlightStroke: "rgba(220,220,220,1)",
                        data: [@foreach($teams->get() as $team)
                                {{$team->statistic()->first()->rp}},
                            @endforeach]
                    },
                ]
            };
            //-------------
            //- BAR CHART -
            //-------------
            var barChartCanvas = $("#barChart").get(0).getContext("2d");
            var barChart = new Chart(barChartCanvas);
            var barChartData = areaChartData;
            var barChartOptions = {
                //Boolean - Whether the scale should start at zero, or an order of magnitude down from the lowest value
                scaleBeginAtZero: true,
                //Boolean - Whether grid lines are shown across the chart
                scaleShowGridLines: true,
                //String - Colour of the grid lines
                scaleGridLineColor: "rgba(0,0,0,.05)",
                //Number - Width of the grid lines
                scaleGridLineWidth: 1,
                //Boolean - Whether to show horizontal lines (except X axis)
                scaleShowHorizontalLines: true,
                //Boolean - Whether to show vertical lines (except Y axis)
                scaleShowVerticalLines: true,
                //Boolean - If there is a stroke on each bar
                barShowStroke: true,
                //Number - Pixel width of the bar stroke
                barStrokeWidth: 2,
                //Number - Spacing between each of the X value sets
                barValueSpacing: 5,
                //Number - Spacing between data sets within X values
                barDatasetSpacing: 1,
                //String - A legend template
                legendTemplate: "<ul class=\"<%=name.toLowerCase()%>-legend\"><% for (var i=0; i<datasets.length; i++){%><li><span style=\"background-color:<%=datasets[i].fillColor%>\"></span><%if(datasets[i].label){%><%=datasets[i].label%><%}%></li><%}%></ul>",
                //Boolean - whether to make the chart responsive
                responsive: true,
                maintainAspectRatio: true
            };

            barChartOptions.datasetFill = false;
            barChart.Bar(barChartData, barChartOptions);

            var areaChartData2 = {
                labels: [
                    @foreach($teams->get() as $team)
                        "{{$team->name}}",
                    @endforeach
                ],
                datasets: [
                    {
                        label: "Electronics",
                        fillColor: "#3498db",
                        strokeColor: "#3498db",
                        pointColor: "#3498db",
                        pointStrokeColor: "#c1c7d1",
                        pointHighlightFill: "#fff",
                        pointHighlightStroke: "rgba(220,220,220,1)",
                        data: [@foreach($teams->get() as $team)
                            {{$team->statistic()->first()->goles}},
                            @endforeach]
                    },
                ]
            };
            var barChartCanvas = $("#barChart2").get(0).getContext("2d");
            var barChart = new Chart(barChartCanvas);
            var barChartData2 = areaChartData2;
            barChart.Bar(barChartData2, barChartOptions);

            var areaChartData3 = {
                labels: [
                    @foreach($teams->get() as $team)
                        "{{$team->name}}",
                    @endforeach
                ],
                datasets: [
                    {
                        label: "Ganados",
                        fillColor: "#1abc9c",
                        strokeColor: "#1abc9c",
                        pointColor: "#1abc9c",
                        pointStrokeColor: "#1abc9c",
                        pointHighlightFill: "#1abc9c",
                        pointHighlightStroke: "#1abc9c",
                        data: [@foreach($teams->get() as $team)
                            {{$team->statistic()->first()->ganados}},
                            @endforeach]
                    },
                    {
                        label: "perdidos",
                        fillColor: "#c0392b",
                        strokeColor: "#c0392b",
                        pointColor: "#c0392b",
                        pointStrokeColor: "#c0392b",
                        pointHighlightFill: "#c0392b",
                        pointHighlightStroke: "#c0392b",
                        data: [@foreach($teams->get() as $team)
                            {{$team->statistic()->first()->perdidos}},
                            @endforeach]
                    },
                ]
            };
            var barChartCanvas = $("#barChart3").get(0).getContext("2d");
            var barChart = new Chart(barChartCanvas);
            var barChartData3 = areaChartData3;
            barChart.Bar(barChartData3, barChartOptions);

            var areaChartData4 = {
                labels: [
                    @foreach($teams->get() as $team)
                        "{{$team->name}}",
                    @endforeach
                ],
                datasets: [
                    {
                        label: "Tarjetas Amarillas",
                        fillColor: "#f1c40f",
                        strokeColor: "#f1c40f",
                        pointColor: "#f1c40f",
                        pointStrokeColor: "#f1c40f",
                        pointHighlightFill: "#f1c40f",
                        pointHighlightStroke: "#f1c40f",
                        data: [@foreach($teams->get() as $team)
                            {{$team->statistic()->first()->ta}},
                            @endforeach]
                    },
                    {
                        label: "Tarjetas Rojas",
                        fillColor: "#c0392b",
                        strokeColor: "#c0392b",
                        pointColor: "#c0392b",
                        pointStrokeColor: "#c0392b",
                        pointHighlightFill: "#c0392b",
                        pointHighlightStroke: "#c0392b",
                        data: [@foreach($teams->get() as $team)
                            {{$team->statistic()->first()->tr}},
                            @endforeach]
                    },
                ]
            };
            var barChartCanvas = $("#barChart4").get(0).getContext("2d");
            var barChart = new Chart(barChartCanvas);
            var barChartData4 = areaChartData4;
            barChart.Bar(barChartData4, barChartOptions);
        })
    @endif

    </script>

@endpush()


