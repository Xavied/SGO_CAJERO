<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Buscar Mesas</title>

        <!-- Fonts -->
        <link href="https://fonts.googleapis.com/css?family=Nunito:200,600" rel="stylesheet">

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


    </head>
    <body>
<div class="ml-3">
    <br>
        <div class="uk-animation-toggle" tabindex="0">
        <a class="uk-button uk-button-default content" href="/">Salir</a>

        </div>

    <br>
    <br>



<div class="uk-child-width-1-2@s uk-child-width-1-3@m uk-text-center" uk-grid>
    @foreach($mesas as $buscarmesas)

            <div>
                <div class="uk-card uk-card-hover uk-card-body">
                    <h3 class="uk-card-title">Mesa: {{$buscarmesas->id}}</h3>
                    <p> {{$buscarmesas->mes_descr}}</p>
                    {!! Form::open(['route'=> 'buscarmesa', 'method'=> 'POST']) !!}
                        {{ Form::hidden('idMesa', $buscarmesas->id) }}
                        <button type="submit" class="uk-button uk-button-primary content">
                            Siguiente
                        </button>
                    {!! Form::close() !!}
                </div>

            </div>


     @endforeach
</div>

<br>
<br>
<div class="uk-animation-toggle" tabindex="0">
<a class="uk-button uk-button-default content" href="/mesaofactura">Volver</a>
</div>
</div>

</body>
</html>
