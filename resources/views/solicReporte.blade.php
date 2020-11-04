@extends('layouts.adminly')

@section('content')
<div class="container mt-4">
  <h2>Ingrese la fecha para generar el reporte</h2>
  <br>
  <div class="container">
    <form action="{{route('tablacrear')}}" method="POST">
      @csrf
      <input type="date" name="fecha" placeholder="Fecha" class="form-control mb-2" value="{{old('fecha')}}">

      <br>
      <button class="btn btn-dark btn-block" type="submit">Generar Reporte</button>
    </form>
  </div>
</div>
@endsection