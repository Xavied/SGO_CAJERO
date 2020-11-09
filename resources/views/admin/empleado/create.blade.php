@extends('layouts.adminly')

@section('content')
<div class="container">
    <div class="row">
        <div class="panel panel-default">
            <div class="panel-heading">
                Crear Empleado
            </div>

            <div class="panel-body">
                {!! Form::open(['route' => 'empleados.store']) !!}

                @include('admin.empleado.partials.form')

                {!! Form::close() !!}
            </div>
        </div>
    </div>
</div>
@endsection