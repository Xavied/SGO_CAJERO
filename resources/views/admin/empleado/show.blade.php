@extends('layouts.adminly')

@section('content')
<div class="container">
    <div class="row">
        <div class="panel panel-default">
            <div class="panel-heading">
                Ver empleado
            </div>

            <div class="panel-body">
                <p><strong>Id</strong> {{$empleadoarr["id"]}}</p>
                <p><strong>Cargo</strong> {{$empleadoarr["emp_crg"]}}</p>
                <p><strong>Cédula</strong> {{$empleadoarr["emp_ci"]}}</p>
                <p><strong>Nombre</strong> {{$empleadoarr["emp_nom"]}}</p>
                <p><strong>Dirección</strong> {{$empleadoarr["emp_dir"]}}</p>
                <p><strong>Teléfono</strong> {{$empleadoarr["emp_telf"]}}</p>
            </div>
        </div>
    </div>
</div>
@endsection