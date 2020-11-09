@extends('layouts.adminly')

@section('content')
<div class="container">
    <div class="row">
        <div class="panel panel-default">
            <div class="panel-heading">
                Editar plato
            </div>

            <div class="panel-body">
                {!! Form::model($empleadoarr, ['route' => ['empleados.update', $empleadoarr["id"]], 'method' => 'PUT']) !!}

                @include('admin.empleado.partials.form')

                {!! Form::close() !!}
            </div>
        </div>
    </div>
</div>
@endsection