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
                     <h1>Pedido</h1>
                <div class=panel>
                    @foreach($detalles['pedidos'] as $cli)

                    <div class="panel-body">
                    Pedido número: {{$cli['id']}}
                    </div>
                    <br>
                    <br>
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
