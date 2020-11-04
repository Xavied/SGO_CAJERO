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

<!------GráficosPorNombre----------------------------------------------------------------------- -->
<div class="container bg-dark text-white p-3 mb-5 text-center">
    <h5>Total de platos vendidos en la semana (Por nombre)</h5>
</div>
<div class="container ">
    <div class="row">
        <div class="col-md-6" id="pastel"></div><!-- Aquí va el gráfico de pastel -->
        <div class="col-md-6" id="barras"></div><!-- Aquí va el gráfico de barras -->
    </div>
</div>
<!-------ENDGráficosPorNombre---------------------------------------------------------------------->

<!-------ReportePorNombreDePlato----------------------------------------------------------------->
<div class="container bg-dark text-white p-3 mb-5 mt-5 text-center">
    <h5>Reporte de platos por día (por nombre)</h5>
</div>
<div class="container ">
    <div class="row">

        <?php $a=0; $totalfinal=0?>

        @foreach($PlatoNombre as $detapla)
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
                        <?php $decimal = number_format($item['dtall_valor'], 2)?>
                        <td scope="col">$ {{$decimal}}</td>
                    </tr>
                    <?php $total+=$item['dtall_valor']; $totalfinal+=$item['dtall_valor']?>
                    @endforeach
                    <tr>
                        <th class="table-warning" scope="col">TOTAL INGRESOS</th>
                        <th class="table-warning" scope="col"></th>
                        <th class="table-warning" scope="col"></th>
                        <?php $decimalparcial = number_format($total, 2)?>
                        <td class="table-warning" scope="col">$ {{$decimalparcial}}</td>
                    </tr>
                </tbody>
            </table>
        </div>
        @endforeach
<!-------ENDReportePorNombreDePlato----------------------------------------------------------------->

<!------GráficosPorTipo----------------------------------------------------------------------- -->
<div class="container bg-dark text-white p-3 mb-5 mt-5 text-center">
    <h5>Total de platos vendidos en la semana (Por tipo)</h5>
</div>
<div class="container ">
    <div class="row">
        <div class="col-md-6" id="pasteltipo"></div><!-- Aquí va el gráfico de pastel -->
        <div class="col-md-6" id="barrastipo"></div><!-- Aquí va el gráfico de barras -->
    </div>
</div>
<!-------ENDGráficosPorTipo---------------------------------------------------------------------->

<!-------ReportePorTipoDePlato----------------------------------------------------------------->
<div class="container bg-dark text-white p-3 mb-5 mt-5 text-center">
    <h5>Reporte de platos por día (por tipo)</h5>
</div>
<div class="container ">
    <div class="row">

        <?php $a=0; $totalfinal=0?>

        @foreach($PlatoTipo as $detapla)
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
                        <td scope="col">{{$item['plt_tipo']}}</td>
                        <td scope="col">{{$item['dtall_cant']}}</td>
                        <?php $decimal = number_format($item['dtall_valor'], 2)?>
                        <td scope="col">$ {{$decimal}}</td>
                    </tr>
                    <?php $total+=$item['dtall_valor']; $totalfinal+=$item['dtall_valor']?>
                    @endforeach
                    <tr>
                        <th class="table-warning" scope="col">TOTAL INGRESOS</th>
                        <th class="table-warning" scope="col"></th>
                        <th class="table-warning" scope="col"></th>
                        <?php $decimalparcial = number_format($total, 2)?>
                        <td class="table-warning" scope="col">$ {{$decimalparcial}}</td>
                    </tr>
                </tbody>
            </table>
        </div>
        @endforeach
<!-------ENDReportePorTIPODePlato----------------------------------------------------------------->

        <!-- GenerarExcel -->
        <div class="container">
            <div class="col d-flex justify-content-end">
                <?php $uno = json_encode($DetalleFecha);?>

                {!! Form::open(['route'=> 'products.excel', 'method'=> 'POST']) !!}
                {{ Form::hidden('PlatoNombre', $uno )}}
                <button type="submit" type="button" class="btn btn-success">
                    Descargar datos en Excel
                </button>
                {!! Form::close() !!}
            </div>        
        </div>        
        <!-- EndGenerarExcel -->

        <div class="container">
            <div class="row justify-content-md-center">
                <div class="bg-dark text-white p-3 mb-5 mt-5 text-center col-9">
                    <h5>Ingresos obtenidos desde {{$dates[0]}} hasta {{$dates[count($dates)-1]}}: </h5>
                </div>
                <div class="bg-warning text-black p-3 mb-5 mt-5 text-center col">
                    <?php $decimaltotal = number_format($totalfinal, 2)?>
                    <h5>${{$decimaltotal}}</h5>
                </div>
            </div>
        </div>
    </div>
</div>
</div>
@endsection

@section('scripts')
<!-- Gráfico de pastel por Nombre------------------------------------------------------------------------>
<script type="text/javascript">
    var il =  <?php echo json_encode($GrafNom2)?>;    
   
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
<!-- Gráfico de pastel por Tipo------------------------------------------------------------------------>
<script type="text/javascript">
    var il =  <?php echo json_encode($GrafTipo2)?>;    
   
    Highcharts.chart('pasteltipo', {
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
<!-- Gráfico de barras por Nombre------------------------------------------------------------------------>
<script type="text/javascript">
    var il =  <?php echo json_encode($GrafNom2)?>;       

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
<!-- Gráfico de barras por Tipo------------------------------------------------------------------------>
<script type="text/javascript">
    var il =  <?php echo json_encode($GrafTipo2)?>;       

    Highcharts.chart('barrastipo', {
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