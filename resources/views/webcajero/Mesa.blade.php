@extends('layouts.cajeroly')
@section('head')
<title>Cajero</title>

       <!-- UIkit CSS -->
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/uikit@3.5.8/dist/css/uikit.min.css" />

        <!-- UIkit JS -->
        <script src="https://cdn.jsdelivr.net/npm/uikit@3.5.8/dist/js/uikit.min.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/uikit@3.5.8/dist/js/uikit-icons.min.js"></script>

         <style>
             .content {
                 background-color: #FFBC30;
                 color:#fff;
            }

        </style>
@endsection
@section('header')
<div class="mt-4">
    <a class="btn btn-outline-primary" href="/buscarmesa">Volver atrás</a>
    <a class="btn btn-outline-danger" href="/">Salir!</a>
</div>

@endsection


@section('content')

<div class="uk-margin uk-margin-large-top uk-placeholder">



    <div class="container">
                     <h2>Facturas de la Mesa: </h2>
                <div class=panel>

                    @foreach($clientes as $cli)

                    <div>
                        <div class="uk-card uk-card-hover uk-card-body">
                            <h3 class="uk-card-title">Factura: {{$cli['idFac']}} </h3>
                            <p> {{$cli['cli_ci']}}</p>
                            <p> {{$cli['cli_nom']}}</p>
                            {!! Form::open(['route'=> 'buscarfactura', 'method'=> 'POST']) !!}
                                {{ Form::hidden('idFac', $cli['idFac']) }}
                                {{ Form::hidden('idPedido', $cli['id']) }}
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
