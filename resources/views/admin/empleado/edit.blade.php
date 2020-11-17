@extends('layouts.adminly')

@section('content')
<div class="container">
    <div class="card">
        <div class="card-body">

            <h5 class="card-title">
                Editar plato
            </h5>

            {!! Form::model($empleadoarr, ['route' => ['empleados.update', $empleadoarr["id"]], 'method' => 'PUT']) !!}

            @include('admin.empleado.partials.form')

            {!! Form::close() !!}
        </div>
    </div>
</div>
@endsection