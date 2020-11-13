<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Laravel</title>

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
<a class="uk-button uk-button-default content" href="/buscarmesa">Volver</a>

</div>

    <br>
    <br>

<div class="uk-margin uk-margin-large-top uk-placeholder">

    <div class="uk-margin">
    <h1 class="uk-text-center">Todavía no hay clientes para esta mesa</h1>
    </div>

</div>
</body>
</html>
