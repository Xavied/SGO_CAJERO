<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- UIkit CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/uikit@3.4.6/dist/css/uikit.min.css" />
    <title>Factura</title>

    <!-- Styles -->
    <style>
             .content {
                 background-color: #FFBC30;
                 color:#fff;
            }

        </style>
</head>
<body>
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

<div class="uk-animation-toggle" tabindex="0">
<a class="uk-button uk-button-default content" href="/buscarmesa">Volver</a>
</div>

<br>

</body>
</html>
