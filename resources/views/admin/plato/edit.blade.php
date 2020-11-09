@extends('layouts.adminly')

@section('content')
<div class="container">
    <div class="row">
        <div class="panel panel-default">
            <div class="panel-heading">
                Editar plato
            </div>

            <div class="panel-body">
                {!! Form::model($platoarr, ['route' => ['platos.update', $platoarr["id"]], 'method' => 'PUT']) !!}

                @include('admin.plato.partials.form')

                {!! Form::close() !!}
            </div>
        </div>
    </div>
</div>
@endsection