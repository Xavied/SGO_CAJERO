@extends('layouts.cajeroly')
@section('head')
<title>Cajero</title>
@endsection
@section('header')
<div class="mt-4">
    <a class="btn btn-outline-primary" href="/cajero">Volver atrás</a>
    <a class="btn btn-outline-danger" href="/">Salir!</a>
</div>

@endsection

@section('content')
<div class="mt-4 mr-1 ml-1 mb-5 row">
  <div class="col-sm-6">
    <div class="card">
        <img src="https://cdn.pixabay.com/photo/2019/08/30/14/52/id-4441548_1280.png" class="card-img-top" width="400px" height="400px">
      <div class="card-body text-center">
        <h5 class="card-title">Buscar por cédula del Cliente</h5>
        <a href="/buscarfactura" class="btn btn-primary">Ir!</a>
      </div>
    </div>
  </div>
  <div class="col-sm-6">
    <div class="card">
        <img src="https://cdn.pixabay.com/photo/2017/02/15/10/39/food-2068217_1280.jpg" class="card-img-top" width="400px" height="400px">
      <div class="card-body text-center">
        <h5 class="card-title"> Buscar por Mesa</h5>
        <a href="/buscarmesa" class="btn btn-primary">Ir!</a>
      </div>
    </div>
  </div>
</div>

@endsection
