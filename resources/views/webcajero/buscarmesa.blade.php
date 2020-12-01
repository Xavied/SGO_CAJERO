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
    <a class="btn btn-outline-primary" href="/mesaofactura">Volver atrás</a>
    <a class="btn btn-outline-danger" href="/">Salir!</a>
</div>

@endsection

@section('content')
<div class="uk-child-width-1-2@s uk-child-width-1-3@m uk-text-center mr-3 ml-3 mt-5" uk-grid>
    @foreach($mesas as $buscarmesas)

            <div>
                <div class="uk-card uk-card-hover uk-card-body ">
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

@endsection
