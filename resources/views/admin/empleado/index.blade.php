@extends('layouts.adminly')
@section('content')


@if(session('info'))
<div class="container">
    <div class=row>
        <div class="alert alert-succes">
            {{session('info')}}
        </div>
    </div>
</div>
@endif

@if(count($errors))
<div class="container">
    <div class=row>
        <div class="alert alert-succes">
            <ul>
                @foreach ($errors->all() as $error)
                <li>{{$error}}</li>
                @endforeach
            </ul>
        </div>
    </div>
</div>
@endif


<div class="container">
    <div class="row">
        <div class="">
            <div class="panel panel-default">
                <div class="panel-heading">
                    Lista de Platos
                    <a href="{{ route('empleados.create') }}" class="pull-right btn btn-sm btn-outline-primary">
                        Crear
                    </a>
                </div>

                <div class="panel-body">

                    <table class="table table-striped table-hover">
                        <thead>
                            <tr>
                                <th width="10px">ID</th>
                                <th>Cédula</th>
                                <th>Cargo</th>
                                <th>Nombre</th>
                                <th>Dirección</th>
                                <th>Teléfono</th>
                                <th colspan="3">&nbsp;</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($empleadosarr as $empleado)
                            <tr>
                                <td>{{$empleado["id"]}}</td>
                                <td>{{$empleado["emp_ci"]}}</td>
                                <td>{{$empleado["emp_crg"]}}</td>
                                <td>{{$empleado["emp_nom"]}}</td>
                                <td>{{$empleado["emp_dir"]}}</td>
                                <td>{{$empleado["emp_telf"]}}</td>

                                <td width="10px">
                                    <a href="{{ route('platos.show', $empleado["id"]) }}"
                                        class="btn btn-sm btn-outline-secondary">Ver</a>
                                </td>
                                <td width="10px">
                                    <a href="{{ route('platos.edit', $empleado["id"]) }}"
                                        class="btn btn-sm btn-outline-secondary">Editar</a>
                                </td>
                                <td width="10px">
                                    {!! Form::open(['route' => ['platos.destroy', $empleado["id"]], 'method' => 'DELETE'])
                                    !!}
                                    <button class="btn btn-sm btn-outline-danger">
                                        Eliminar
                                    </button>
                                    {!! Form::close() !!}
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection