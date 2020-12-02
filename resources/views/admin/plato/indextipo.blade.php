@extends('layouts.adminly')
@section('content')
<div class="container">
    <div class="row">
        <div class="card col">
            <img class="card-img-top" src="{{ asset('images/aperitivos.jpg') }}" alt="AperitivosImage" style="height:17vw;">
            <div class="card-body">
                <h5 class="card-title">Aperitivos</h5>
                <a href="{{ route('platos.portipo', "Aperitivo") }}" class="btn btn-sm btn-outline-secondary">Ver</a>
            </div>
        </div>
        <div class="card col" >
            <img class="card-img-top" src="{{ asset('images/sopas.jpg') }}" alt="SopasImage" style="height:17vw;">
            <div class="card-body">
                <h5 class="card-title">Sopas</h5>
                <a href="{{ route('platos.portipo', "Sopa") }}" class="btn btn-sm btn-outline-secondary">Ver</a>
            </div>
        </div>
        <div class="card col">
            <img class="card-img-top" src="{{ asset('images/platosfuertes.jpg') }}" alt="PlatosFuertesImage" style="height:17vw;">
            <div class="card-body">
                <h5 class="card-title">Platos Fuertes</h5>
                <a href="{{ route('platos.portipo', "Plato_Fuerte") }}" class="btn btn-sm btn-outline-secondary">Ver</a>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="card col">
            <img class="card-img-top" src="{{ asset('images/ensaladas.jpg') }}" alt="EnsaladasImage" style="height:17vw;">
            <div class="card-body">
                <h5 class="card-title">Ensaladas</h5>
                <a href="{{ route('platos.portipo', "Ensalada") }}" class="btn btn-sm btn-outline-secondary">Ver</a>
            </div>
        </div>
        <div class="card col">
            <img class="card-img-top" src="{{ asset('images/mariscos.jpg') }}" alt="MariscosImage" style="height:17vw;">
            <div class="card-body">
                <h5 class="card-title">Mariscos</h5>
                <a href="{{ route('platos.portipo', "Marisco") }}" class="btn btn-sm btn-outline-secondary">Ver</a>
            </div>
        </div>
        <div class="card col">
            <img class="card-img-top" src="{{ asset('images/bebidas.jpg') }}" alt="BebidasImage" style="height:17vw;">
            <div class="card-body">
                <h5 class="card-title">Bebidas</h5>
                <a href="{{ route('platos.portipo', "Bebida") }}" class="btn btn-sm btn-outline-secondary">Ver</a>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="card col">
            <img class="card-img-top" src="{{ asset('images/postres.jpg') }}" alt="PostresImage" style="height:17vw;">
            <div class="card-body">
                <h5 class="card-title">Postres</h5>
                <a href="{{ route('platos.portipo', "Postre") }}" class="btn btn-sm btn-outline-secondary">Ver</a>
            </div>
        </div>
        <div class="card col">
            <img class="card-img-top" src="{{ asset('images/promociones.jpg') }}" alt="PromocionesImage" style="height:17vw;">
            <div class="card-body">
                <h5 class="card-title">Promociones</h5>
                <a href="{{ route('platos.portipo', "promocion") }}" class="btn btn-sm btn-outline-secondary">Ver</a>
            </div>
        </div>        
    </div>    
</div>>
@endsection