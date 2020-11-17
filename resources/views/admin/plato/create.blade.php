@extends('layouts.adminly')

@section('content')
<div class="container">
    <div class="card">
        <div class="card-body">
            <h5 class="card-title">
                Crear plato
            </h5>

            {!! Form::open(['route' => 'platos.store']) !!}

            @include('admin.plato.partials.form')

            {!! Form::close() !!}
        </div>
    </div>

</div>
@endsection