@extends('layouts.cajeroly')
@section('head')
<title>Cajero</title>
@endsection
@section('header')
<div class="mt-4">
    <a class="btn btn-outline-primary" href="/mesaofactura">Volver atrás</a>
    <a class="btn btn-outline-danger" href="/">Salir!</a>
</div>
@endsection


@section('content')

    </div>
    <div class="mt-5 row justify-content-center">
        <div class="card" style="width: 50%;">
            <div class="card-body">
              <h5 class="card-title text-center">Buscar Cédula</h5>
              <form action='/buscarfacturacliente' method="POST">
                {{csrf_field()}}
                    <div class="form-group">
                        <input id="cli_cedula"  type="numeric" class="form-control @error("cli_cedula") is-invalid @enderror" name="cli_cedula" placeholder="número de cédula del cliente" required autocomplete="current-password" autofocus>
                        @error("cli_cedula")
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                    </div>
                    <div class="mt-1">
                    <button class="btn btn-primary" type=submit>Buscar</button>

                    </div>
                        </div>

                </form>

            </div>
          </div>
    </div>

@endsection
