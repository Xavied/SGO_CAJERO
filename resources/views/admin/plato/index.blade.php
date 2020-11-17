@extends('layouts.adminly')
@section('content')

<div class="container">
    <div class="">
        <div class="card">


            <div class="card-body">

                <h5 class="card-title">
                    Lista de Platos
                </h5>

                <a href="{{ route('platos.create') }}" class="pull-right btn btn-sm btn-outline-primary mb-2">
                    Agregar plato
                </a>


                <table class="table table-striped table-hover">
                    <thead>
                        <tr>
                            <th width="10px">ID</th>
                            <th>Nombre</th>
                            <th>Tipo</th>
                            <th>Visible</th>
                            <th>IVA</th>
                            <th>PVP</th>
                            <th colspan="3">&nbsp;</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($platosarr as $plato)
                        <tr>
                            <td>{{$plato["id"]}}</td>
                            <td>{{$plato["plt_nom"]}}</td>
                            <td>{{$plato["plt_tipo"]}}</td>
                            <td>
                                @if($plato["plt_visbl"] == true)

                                Si

                                @else

                                No

                                @endif
                            </td>
                            <td>
                                @if($plato["plt_iva"] == true)

                                Si

                                @else

                                No

                                @endif
                            </td>
                            <td>{{$plato["plt_pvp"]}}</td>

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
@endsection