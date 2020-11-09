@extends('layouts.adminly')

@section('content')
  <style>
        a.active.nav-link{background-color: #feb236!important;}
        a {color: black;}
    </style>

<div class="container">
  <div class="row">
    <div class="col-3">
      <div class="nav flex-column nav-pills mt-3" id="v-pills-tab" role="tablist" aria-orientation="vertical">
        <a class="nav-link active" id="v-pills-home-tab" data-toggle="pill" href="#v-pills-home" role="tab" aria-controls="v-pills-home" aria-selected="true">Reporte de platos por semana</a>
        <a class="nav-link inactive" id="v-pills-profile-tab" data-toggle="pill" href="#v-pills-profile" role="tab" aria-controls="v-pills-profile" aria-selected="false">Solicitar facturas por día</a>
      </div>
    </div>
    <div class="col-9">
      <div class="tab-content" id="v-pills-tabContent">
        <div class="tab-pane fade show active" id="v-pills-home" role="tabpanel" aria-labelledby="v-pills-home-tab">
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
        </div>
        <div class="tab-pane fade" id="v-pills-profile" role="tabpanel" aria-labelledby="v-pills-profile-tab">
          <div class="container mt-4">
            <h2>Ingrese la fecha de la que desea visualizar las facturas</h2>
            <br>
            <div class="container">
              <form action="{{route('facsDia')}}" method="POST">
                @csrf
                <input type="date" name="fecha" placeholder="Fecha" class="form-control mb-2" value="{{old('fecha')}}">

                <br>
                <button class="btn btn-dark btn-block" type="submit">Ver Facturas</button>
              </form>
            </div>
          </div>
        </div>
      </div>
    </div>   
  </div>
</div>



@endsection