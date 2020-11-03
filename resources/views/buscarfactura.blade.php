<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Factura</title>

        <!-- Fonts -->
        <link href="https://fonts.googleapis.com/css?family=Nunito:200,600" rel="stylesheet">
        <!-- UIkit CSS -->
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/uikit@3.4.6/dist/css/uikit.min.css" />
         <!-- Styles -->
         <style>
             .content {
                 background-color: #FFBC30;
                 color:#fff;
            }

        </style>


    </head>
    <body>
    <br>
<div class="uk-animation-toggle" tabindex="0">
<a class="uk-button uk-button-default content" href="/">Salir</a>

</div>

    <br>
    <br>


<div class="uk-margin uk-margin-large-top uk-placeholder">
<form action='/buscarfacturacliente' method="POST">
{{csrf_field()}}
    <div class="uk-margin">
        <input class="uk-input uk-form-width-medium" name="cli_cedula" type="numeric" placeholder="número de cédula del cliente">
    </div>
    <br>
    <br>
        <div class="uk-animation-toggle" tabindex="0">
            <div class="uk-card uk-card-default uk-card-body uk-animation-fade">
                <p class="uk-text-center">
               <button class="uk-button uk-button-primary content" type=submit>Siguiente</button>
                </p>
            </div>
        </div>

</form>

</div>

<br>
<div class="uk-animation-toggle" tabindex="0">
<a class="uk-button uk-button-default content" href="/mesaofactura">Volver</a>

</div>
<br>






    </body>
</html>
