@extends('layouts.adminly')


@section('content')

    <!-- <style>
        ol.breadcrumb {background-color:white}
    </style>

<div class="container">
    <nav aria-label="breadcrumb">
    <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="form">Reportes</a></li>
        <li class="breadcrumb-item"><a href="form">Solicitar facturas por día</a></li>
        <li class="breadcrumb-item active" aria-current="page">Facturas de {{$fechaR}}</li>
    </ol>
    </nav>
</div> -->

<div class="container bg-dark text-white p-3 mb-5 mt-5 text-center">
    <h5>Facturas generadas en {{$fechaR}}</h5>
</div>
<div class="container">
    <table class="table">
        <thead class="thead-light">
            <tr>
            <th scope="col">ID Factura</th>
            <th scope="col">Cédula Cliente</th>
            <th scope="col">Nombre Cliente</th>
            <th scope="col"></th>
            </tr>
        </thead>
        <tbody>
        @foreach($DatosFacs as $Factura)
            <?php $data = $Factura['data']; $cliente = $Factura['cliente'];?>
            <tr>
                <th scope="row">{{$data['id']}}</th>
                <td>{{$cliente['cli_ci']}}</td>
                <td>{{$cliente['cli_nom']}}</td>
                <td>
                <?php $uno = json_encode($Factura); ?>
                {!! Form::open(['route'=> 'facturaindividual', 'method'=> 'POST']) !!}                
                    {{ Form::hidden('Datos', $uno )}}                 
                    <button type="submit" type="button" class="btn btn-secondary">
                        Ver Factura
                    </button>
                    {!! Form::close() !!}                
                </td>
            </tr>
            @endforeach           
        </tbody>
    </table>
</div>


@endsection