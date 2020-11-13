@extends('layouts.cajeroly')
@section('head')
<title>Cajero</title>
@endsection
@section('header')
<div class="mt-4">
    <a class="btn btn-outline-danger" href="/">Salir</a>
</div>

@endsection



@section('content')
<div class="mt-5 row justify-content-center">
    <div class="card" style="width: 50%;">
        <img src="https://cdn.pixabay.com/photo/2020/09/28/16/05/cash-register-5610295_1280.jpg" class="card-img-top" alt="...">
        <div class="card-body">
          <h5 class="card-title text-center">Imprimir Factura</h5>
          <div class="text-center">
            <a href="/mesaofactura" class="btn btn-primary">Ir!</a>
          </div>

        </div>
      </div>
</div>


@endsection
