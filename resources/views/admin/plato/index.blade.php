@extends('layouts.adminly')
@section('content')


@if(session('info'))
<div class="container">
    <div class="alert alert-success" role="alert">
        {{session('info')}}
    </div>
</div>
@endif

@if(count($errors))
<div class="container">
    <div class="alert alert-danger" role="alert">
        <ul>
            @foreach ($errors->all() as $error)
            <li>{{$error}}</li>
            @endforeach
        </ul>
    </div>
</div>
@endif


<div class="container">
    <div class="row">
        <div class="">
            <div class="panel panel-default">
                <div class="panel-heading">
                    Lista de Platos
                    <a href="{{ route('platos.create') }}" class="pull-right btn btn-sm btn-outline-primary">
                        Crear
                    </a>
                </div>

                <div class="panel-body">

                    <table class="table table-striped table-hover">
                        <thead>
                            <tr>
                                <th width="10px">ID</th>
                                <th>Nombre</th>
                                <th>Descripción</th>
                                <th>Tipo</th>
                                <th>PVP</th>
                                <th>IVA</th>
                                <th>Visibilidad</th>
                                <th colspan="3">&nbsp;</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($platosarr as $plato)
                            <tr>
                                <td>{{$plato["id"]}}</td>
                                <td>{{$plato["plt_nom"]}}</td>
                                <td>{{$plato["plt_des"]}}</td>
                                <td>{{$plato["plt_tipo"]}}</td>
                                <td>{{$plato["plt_pvp"]}}</td>
                                <td>{{$plato["plt_iva"]}}</td>
                                <td>{{$plato["plt_visbl"]}}</td>

                                <td width="10px">
                                    <a href="{{ route('platos.show', $plato["id"]) }}"
                                        class="btn btn-sm btn-outline-secondary">Ver</a>
                                </td>
                                <td width="10px">
                                    <a href="{{ route('platos.edit', $plato["id"]) }}"
                                        class="btn btn-sm btn-outline-secondary">Editar</a>
                                </td>
                                <td width="10px">
                                    {!! Form::open(['route' => ['platos.destroy', $plato["id"]], 'method' => 'DELETE'])
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