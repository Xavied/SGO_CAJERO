@extends('layouts.adminly')

@section('head')
<!-- Librería HighCharts -->
<script src="https://code.highcharts.com/highcharts.js"></script>

<title>Reporte {{$keys[0]}}</title>
@endsection

@section('content')

<div class="container mt-5 mb-5">
    <h2 class="text-center">Semana desde {{$dates[0]}} hasta {{$dates[count($dates)-1]}}</h2>
</div>

<!------Gráficos----------------------------------------------------------------------- -->
<div class="container bg-dark text-white p-3 mb-5 text-center">
    <h5>Total de platos vendidos</h5>
</div>
<div class="container ">
    <div class="row">
        <div class="col-6" id="pastel"></div><!-- Aquí va el gráfico de pastel -->
        <div class="col-6" id="barras"></div><!-- Aquí va el gráfico de barras -->
    </div>
</div>
<!-------EndGráficos---------------------------------------------------------------------->

<div class="container bg-dark text-white p-3 mb-5 mt-5 text-center">
    <h5>Reporte de platos por día</h5>
</div>
<div class="container ">
    <div class="row">

        <?php $a=0; $totalfinal=0?>

        @foreach($lol as $detapla)
        <div class="col-md-6">
            <table class="table table-striped table-sm" style="text-align:center;">
                <?php $total=0;?>
                <thead class="thead-dark">
                    <tr>
                        <th scope="col">{{$keys[$a]}}</th>
                        <th scope="col">PLATO</th>
                        <th scope="col">CANTIDAD</th>
                        <th scope="col">INGRESO</th>
                    </tr>
                </thead>
                <?php $a++;?>
                <tbody>
                    @foreach($detapla as $item)
                    <tr>
                        <td scope="col"></td>
                        <td scope="col">{{$item['plt_nom']}}</td>
                        <td scope="col">{{$item['dtall_cant']}}</td>
                        <?php $ingreso = $item['dtall_cant']*$item['plt_pvp'];?>
                        <td scope="col">$ {{$ingreso}}</td>
                    </tr>
                    <?php $total+=$ingreso; $totalfinal+=$ingreso?>
                    @endforeach
                    <tr>
                        <th class="table-warning" scope="col">TOTAL INGRESOS</th>
                        <th class="table-warning" scope="col"></th>
                        <th class="table-warning" scope="col"></th>
                        <td class="table-warning" scope="col">$ {{$total}}</td>
                    </tr>
                </tbody>
            </table>
        </div>
        @endforeach

        <!-- Prueba Tabla 2 ---------------------------------------------------------------------->
        <div class="container bg-dark text-white p-3 mb-5 mt-5 text-center">
            <h5>Reporte de platos por sección</h5>
        </div>
        <?php $a=0; $totalfinal=0?>
        @foreach($TiPlt3 as $detapla)
        <div class="col-md-6">
            <table class="table table-striped table-sm" style="text-align:center;">
                <?php $total=0;?>
                <thead class="thead-dark">
                    <tr>
                        <th scope="col">{{$keysTP[$a]}}</th>
                        <th scope="col">SECCIÓN</th>
                        <th scope="col">CANTIDAD</th>
                        <th scope="col">INGRESO</th>
                    </tr>
                </thead>
                <?php $a++;?>
                <tbody>
                    @foreach($detapla as $item)
                    <tr>
                        <td scope="col"></td>
                        <td scope="col">{{$item['plt_tipo']}}</td>
                        <td scope="col">{{$item['dtall_cant']}}</td>
                        <?php $ingreso = $item['dtall_cant']*$item['plt_pvp'];?>
                        <td scope="col">$ {{$ingreso}}</td>
                    </tr>
                    <?php $total+=$ingreso; $totalfinal+=$ingreso?>
                    @endforeach
                    <tr>
                        <th class="table-warning" scope="col">TOTAL INGRESOS</th>
                        <th class="table-warning" scope="col"></th>
                        <th class="table-warning" scope="col"></th>
                        <td class="table-warning" scope="col">$ {{$total}}</td>
                    </tr>
                </tbody>
            </table>
        </div>
        @endforeach
        <!-- end prueba tabla 2 -->

        <!-- GenerarExcel -->
        <div class="col d-flex justify-content-end">
            <?php $uno = json_encode($lol); $dos = json_encode($keys);?>

            {!! Form::open(['route'=> 'products.excel', 'method'=> 'POST']) !!}
            {{ Form::hidden('lol', $uno )}}
            {{ Form::hidden('keys', $dos )}}
            <button type="submit" type="button" class="btn btn-success">
                Descargar datos en Excel
            </button>
            {!! Form::close() !!}
        </div>
        <!-- EndGenerarExcel -->

        <div class="container">
            <div class="row justify-content-md-center">
                <div class="bg-dark text-white p-3 mb-5 mt-5 text-center col-9">
                    <h5>Ingresos obtenidos desde {{$dates[0]}} hasta {{$dates[count($dates)-1]}}: </h5>
                </div>
                <div class="bg-warning text-black p-3 mb-5 mt-5 text-center col">
                    <h5>${{$totalfinal}}</h5>
                </div>
            </div>
        </div>
    </div>
</div>
</div>
@endsection

@section('scripts')
<!-- Gráfico de pastel ------------------------------------------------------------------------>
<script type="text/javascript">
    var il =  <?php echo json_encode($agrupGraf)?>;    
   
    Highcharts.chart('pastel', {
        chart: {
            plotBackgroundColor: null,
            plotBorderWidth: null,
            plotShadow: false,
            type: 'pie'
        },
        colorAxis: {},
        title: {
            text: 'Platos vendidos en toda la semana'
        },
        tooltip: {
            pointFormat: '{series.name}: <b>{point.percentage:.1f}%</b>'
        },
        accessibility: {
            point: {
                valueSuffix: '%'
            }
        },
        plotOptions: {
            pie: {
                allowPointSelect: true,
                cursor: 'pointer',
                dataLabels: {
                    enabled: true,
                    format: '<b>{point.name}</b>: {point.percentage:.1f} %'
                }
            }
        },

        series: [{
            name: 'Platos',
            colorByPoint: true,
            data: il        
        }]
    });
</script>
<!-- Gráfico de barras ------------------------------------------------------------------------>
<script type="text/javascript">
    var il =  <?php echo json_encode($agrupGraf)?>;       

    Highcharts.chart('barras', {
        chart: {
            type: 'column'
        },
        title: {
            text: 'Platos vendidos en toda la semana'
        },
        subtitle: {
            text: 'SGO'
        },
        xAxis: {
            categories:     
                il     
            ,
            crosshair: true
        },
        yAxis: {
            min: 0,
            title: {
                text: 'Número de platos vendidos'
            }
        },
        tooltip: {
            headerFormat: '<span style="font-size:10px">{point.key}</span><table>',
            pointFormat: '<tr><td style="color:{series.color};padding:0">{series.name}: </td>' +
                '<td style="padding:0"><b>{point.y} platos</b></td></tr>',
            footerFormat: '</table>',
            shared: true,
            useHTML: true
        },
        plotOptions: {
            column: {
                pointPadding: 0.2,
                borderWidth: 0
            }
        },
        series: [{data: il, color: '#FF8800'}]
    });
</script>
@endsection