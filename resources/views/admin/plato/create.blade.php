@extends('layouts.adminly')

@section('content')
<div class="container">
    <div class="row">
        <div class="panel panel-default">
            <div class="panel-heading">
                Crear plato
            </div>

            <div class="panel-body">
                {!! Form::open(['route' => 'platos.store']) !!}

                @include('admin.plato.partials.form')

                {!! Form::close() !!}
            </div>
        </div>
    </div>
</div>
@endsection