@extends('layouts.adminly')

@section('content')
<div class="container">
    <div class="card">

        <div class="card-body">
            <h5 class="card-title">
                Ver plato
            </h5>

            <p><strong>Id</strong> {{$platoarr["id"]}}</p>
            <p><strong>Nombre</strong> {{$platoarr["plt_nom"]}}</p>
            <p><strong>Descripción</strong> {{$platoarr["plt_des"]}}</p>
            <p><strong>Tipo</strong> {{$platoarr["plt_tipo"]}}</p>
            <p><strong>PVP</strong> {{$platoarr["plt_pvp"]}}</p>
            <p><strong>Iva</strong>
                @if($platoarr["plt_iva"] == true)

                Si

                @else

                No

                @endif
            </p>
            <p><strong>Plato visible</strong>
                @if($platoarr["plt_visbl"] == true)

                Si

                @else

                No

                @endif
            </p>
        </div>
    </div>
</div>
@endsection