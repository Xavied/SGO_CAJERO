<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <script src="https://kit.fontawesome.com/973b676a33.js" crossorigin="anonymous"></script>
    <title>Factura {{$DatosFac['data']['id']}}</title>
  </head>
  <style>
      body{margin-bottom: 20px;}
      .container{width:750px;  background-color: #eeeeee; padding: 30px; padding-bottom: 15px;}
      #factura{border: 1px solid black; padding: 15px;}
      
  </style>
  <body>

    <nav class="navbar navbar-dark bg-dark">
    {!! Form::open(['route'=> 'facsDia', 'method'=> 'POST']) !!}
                    {{ Form::hidden('fecha', $Fecha)}}
                    <button type="submit" type="button" class="btn btn-secondary">
                    <i class="fas fa-arrow-circle-left"></i> Regresar a facturas
                    </button>
                    {!! Form::close() !!}  
        <!-- <a class="navbar-brand ml-4" href="#"><i class="fas fa-arrow-circle-left"></i> Regresar a facturas</a> -->
    
    </nav>
    <div class="container mt-4">
        <div class="d-flex justify-content-end block mb-3" >
            <div>
                <h1>
                Factura # {{ str_pad ($DatosFac['data']['id'], 7, '0', STR_PAD_LEFT) }}
                </h1>
                <div class="formato">
                Nombre de la empresa: Restaurantes X
                </br>
                Fecha: {{ $DatosFac['data']['fct_fch']}}
                </br>
                E-mail: restaurantesX@gmail.com
                </div>
            </div>            
        </div>    
        
        <div class= mb-3 id="factura">
            <table >
                <tr>
                    <th style="width:200px;">
                    Nombre del cliente
                    </th>
                    <td>{{$DatosFac['cliente']['cli_nom']}}</td>
                </tr>
                <tr>
                    <th>Cédula / Ruc </th>
                    <td>{{$DatosFac['cliente']['cli_ci']}}</td>
                </tr>

                <tr>
                    <th>Telefono</th>
                    <td>{{$DatosFac['cliente']['cli_telf']}}</td>
                </tr>
                <tr>
                    <th>Cédula / Email </th>
                    <td>{{$DatosFac['cliente']['cli_email']}}</td>
                </tr>
                <tr>
                    <th>Dirección</th>
                    <td>{{$DatosFac['cliente']['cli_dir']}}</td>
                </tr>
            </table>
        </div>           
    
        <table class="table">
            <thead>
                <tr>
                    <th class="text-left" style="width:15px;" >Cantidad</th>
                    <th class="text-center" style="width:200px;">Detalle</th>
                    <th class="text-right" style="width:100px;">PVU</th>
                    <th class="text-right" style="width:100px;">Total</th>
                </tr>
            </thead>
            <tbody>
                @foreach($DatosFac['detalles_de_platos'] as $detapla)
                            <tr>
                                <td class="text-center" >{{$detapla['dtall_cant']}}</td>
                                <td class="text-center">{{$detapla['plt_nom']}}</td>
                                <?php $deci = $detapla['plt_pvp']/1.12; $decimal = number_format($deci, 2)?>
                                <td class="text-right">{{$decimal}}</td>
                                <?php $decimal = number_format($detapla['dtall_valor'], 2)?>
                                <?php $deci = $detapla['dtall_valor']/1.12; $decimal = number_format($deci, 2)?>
                                <td class="text-right">{{$decimal}}</td>
                            </tr>
                @endforeach
            </tbody>
        </table>

        <table class="table">
            <tr>
                <td colspan="3" class="text-right"><b>Sub Total</b></td>
                <td class="text-right">{{ $subtotal }}</td>
            </tr>
            <tr>
                <td colspan="3" class="text-right" style="width:300px"><b>IVA</b></td>
                <td class="text-right"> {{$IVA}}</td>
            </tr>

            <tr>
                <td colspan="3" class="text-right"><b>Total</b></td>
                <td class="text-right">{{$total }}</td>
            </tr>
        </table>
    </div>
</body>
</html>



