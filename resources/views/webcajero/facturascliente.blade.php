@extends('layouts.cajeroly')
@section('head')
<title>Cajero</title>

<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<!-- UIkit CSS -->
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/uikit@3.4.6/dist/css/uikit.min.css" />

@endsection
@section('header')
<div class="mt-4">
    <a class="btn btn-outline-primary" href="/mesaofactura">Volver atrás</a>
    <a class="btn btn-outline-danger" href="/">Salir!</a>
</div>

@endsection

@section('content')
    <div class="uk-margin uk-margin-large-top uk-placeholder">



        <div class="container">
                        <h2>Facturas del cliente</h2>
                    <div class=panel>

                        @foreach($facs as $cli)

                        <div>
                            <div class="uk-card uk-card-hover uk-card-body">
                                <h3 class="uk-card-title">Factura: {{$cli['idFac']}} </h3>
                                <p> {{$cli['cli_ci']}}</p>
                                <p> {{$cli['cli_nom']}}</p>
                                {!! Form::open(['route'=> 'buscarfactura', 'method'=> 'POST']) !!}
                                    {{ Form::hidden('idFac', $cli['idFac']) }}
                                    {{ Form::hidden('idPedido', $cli['idPedido']) }}
                                    <button type="submit" class="uk-button uk-button-primary content">
                                        Siguiente
                                    </button>
                                {!! Form::close() !!}
                            </div>

                        </div>
                        @endforeach



                    </div>


        </div>


    </div>
@endsection


