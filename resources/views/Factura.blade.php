<!DOCTYPE html>
<html lang="es">
<head>

    <!-- Compressed CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/foundation-sites@6.6.3/dist/css/foundation.min.css" integrity="sha256-ogmFxjqiTMnZhxCqVmcqTvjfe1Y/ec4WaRj/aQPvn+I=" crossorigin="anonymous">

    <!-- Compressed JavaScript -->
    <script src="https://cdn.jsdelivr.net/npm/foundation-sites@6.6.3/dist/js/foundation.min.js" integrity="sha256-pRF3zifJRA9jXGv++b06qwtSqX1byFQOLjqa2PTEb2o=" crossorigin="anonymous"></script>


        <!-- Compressed CSS -->
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/foundation-sites@6.6.3/dist/css/foundation.min.css" integrity="sha256-ogmFxjqiTMnZhxCqVmcqTvjfe1Y/ec4WaRj/aQPvn+I=" crossorigin="anonymous">
    <!-- Compressed JavaScript -->

    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" integrity="sha384-JcKb8q3iqJ61gNV9KGb8thSsNjpSL0n8PARn9HuZOnIxN0hoP+VmmDGMN5t9UJ0Z" crossorigin="anonymous">
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js" integrity="sha384-9/reFTGAW83EW2RDu2S0VKaIzap3H66lZH81PoYlFhbGU+6BZp6G7niu735Sk7lN" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js" integrity="sha384-B4gt1jrGC7Jh4AgTPSdUtOBvfO8shuf57BaghqFfPlYxofvL8/KUEfYiJOMMV+rV" crossorigin="anonymous"></script>
        
    <style>
    *{margin: 0 ;padding:0;}
    html{background-color:#f79d20}
    body{width:750px; height:750px; margin:auto; }
    .items{border-spacing:0;}
    
    .items thead{background:#ddd;}          
    .items1{width:;float:right}
    .header{float:right}    
    .client-detail{width:5px}
    .formato{float:left}
    
    
    </style>
    </head>
    <body>
    <header>
    <div class="header">
        <h1>
        Factura # {{ str_pad ($facs->data->id, 7, '0', STR_PAD_LEFT) }}
        </h1>
        <div class="formato">
        Nombre de la empresa:Restaurantes X
        </br>
        Fecha: {{ $facs->data->fct_fch }}
        </br>
        e-mail: restaurantesX@gmail.com
        </div>
    </div>
        <table class="col-xs-2">
             
        </table>
    
    </div>
    <section id="logo">
    <table>
    <tr>
            <th style="width:200px;">
            Nombre del cliente
            </th>
            <td>{{$facs->cliente->cli_nom }}</td>
        </tr>
        <tr>
            <th>Cédula / Ruc </th>
            <td>{{$facs->cliente->cli_ci }}</td>
        </tr>
      
        <tr>
            <th>Telefono</th>
            <td>{{$facs->cliente->cli_telf }}</td>
        </tr>
        <tr>
            <th>Dirección</th>
            <td>{{$facs->cliente->cli_dir }}</td>
        </tr>
    </table>
    </section>


    <section id="loggin"> </section>
    </header>
    <nav></nav>
    <main>
    <table class="items">
            <thead>
                <tr>
                    <th class="text-left" style="width:15px;" >Cantidad</th>
                    <th class="text-center" style="width:200px;">Detalle</th>
                    <th class="text-right" style="width:100px;">PVP</th>
                    <th class="text-right" style="width:100px;">Total</th>
                </tr>
            </thead>
            <tbody>
            @foreach($detalles['detalles_de_platos'] as $detapla)
                        <tr>
                            <td class="text-left" >{{$detapla['dtall_cant']}}</td>
                            <td class="text-center">{{$detapla['plt_nom']}}</td>
                            <td class="text-right">{{$detapla['plt_pvp']}}</td>
                            <td class="text-right">{{$detapla['dtall_valor']}}</td>
                        </tr>
            @endforeach
             
            </tbody>
            <table class="items1">
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
     </table>
                
        

    </main>


    <br>  
    <div class="uk-animation-toggle" tabindex="0">

    <a href="/mesaofactura" class="button">Volver</a>
    <a href="{{"/imprimir/$idFac"}}" class="button">Imprimir</a>
    </div>

</body>
</html> 

