@extends('layouts.cajeroly')
@section('head')
<title>Cajero</title>
@endsection
@section('header')
<div class="mt-4">
    <a class="btn btn-outline-primary" href="/">Volver atrás</a>

</div>

@endsection

@section('content')

<div class="mt-4 mr-1 ml-1 mb-5 row justify-content-center">
  <div class="col-sm-6">
    <div class="card">

      <div class="card-body text-center">
        <h5 class="card-title">El usuario o la contraseña son incorrectos</h5>
      </div>
      <img src="https://cdn.pixabay.com/photo/2017/06/08/17/32/not-found-2384304_1280.jpg" class="card-img-top" width="400px" height="400px">
  </div>
</div>

@endsection
