@extends('layouts.adminly')

@section('content')
<div class="container">
    <div class="row">
        <div class="panel panel-default">
            <div class="panel-heading">
                Ver etiqueta
            </div>

            <div class="panel-body">
                <p><strong>Id</strong> {{$platoarr["id"]}}</p>
                <p><strong>Nombre</strong> {{$platoarr["plt_nom"]}}</p>
                <p><strong>Descripción</strong> {{$platoarr["plt_des"]}}</p>
                <p><strong>Tipo</strong> {{$platoarr["plt_tipo"]}}</p>
                <p><strong>PVP</strong> {{$platoarr["plt_pvp"]}}</p>
                <p><strong>Iva</strong> {{$platoarr["plt_iva"]}}</p>
                <p><strong>Plato visible</strong> {{$platoarr["plt_visbl"]}}</p>
            </div>
        </div>
    </div>
</div>
@endsection