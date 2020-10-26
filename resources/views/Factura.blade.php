<!DOCTYPE html>
<html lang="es">
<head>
 ChristianM_rama
    <!-- Compressed CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/foundation-sites@6.6.3/dist/css/foundation.min.css" integrity="sha256-ogmFxjqiTMnZhxCqVmcqTvjfe1Y/ec4WaRj/aQPvn+I=" crossorigin="anonymous">

    <!-- Compressed JavaScript -->
    <script src="https://cdn.jsdelivr.net/npm/foundation-sites@6.6.3/dist/js/foundation.min.js" integrity="sha256-pRF3zifJRA9jXGv++b06qwtSqX1byFQOLjqa2PTEb2o=" crossorigin="anonymous"></script>
    <!-- UIkit CSS
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/uikit@3.4.6/dist/css/uikit.min.css" /> -->
    <style>
             .content {
                 background-color: #FFBC30;
                 color:#fff;
            }
            .blanco
            {
                color: #000000;
                background-color: #fff;

            }

        </style>
   <title>Factura</title>
</head>
<body>
<div class="uk-container">

                    <table class="uk-table content">
                        <caption><h2>Factura</h2></caption>

                        <tbody>
                        <tr>
                                <td>

                                    <div>
                                        <div class="uk-card uk-card-small uk-card-body blanco">Número de Factura:    <span class="uk-label content">{{$facs->data->id }}</span></div>
                                    </div>

                                </td>


                        </tr>
                            <tr>
                                <td>

                                    <div>
                                        <div class="uk-card uk-card-small uk-card-body blanco">Cédula del Cliente:    <span class="uk-label content">{{$facs->cliente->cli_ci }}</span></div>
                                    </div>

                                </td>

                                <td>

                                    <div>
                                        <div class="uk-card uk-card-small uk-card-body blanco">Razón Social: <span class="uk-label content"><!--{{ $facs->empleado }}--> 1710101010001</span></div>
                                    </div>


                                </t>
         master


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
 ChristianM_rama
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

                            <tr>
                                <td>

                                    <div>
                                        <div class="uk-card uk-card-small uk-card-body blanco">Teléfonon del Cliente:    <span class="uk-label content">{{$facs->cliente->cli_telf }}</span></div>
                                    </div>

                                </td>




                            </tr>
                            <tr>
                                <td>

                                    <div>
                                        <div class="uk-card uk-card-small uk-card-body blanco">Correo del Cliente:    <span class="uk-label content">{{$facs->cliente->cli_email }}</span></div>
                                    </div>

                                </td>
                                <td>

                                    <div>
                                        <div class="uk-card uk-card-small uk-card-body blanco">Fecha:    <span class="uk-label content">{{ $facs->data->fct_fch }}</span></div>
                                    </div>

                                </td>




                            </tr>

                        </tbody>
                    </table>
</div>
<br>
<br>

<div class="uk-container ">
        <table class="uk-table uk-table-divider uk-text-center content ">
            <caption><span  class="uk-label blanco"> <h2>Detalle</h2></caption>
            <br>
                <thead>
                    <tr>
                        <th class="uk-text-center blanco">Plato</th>
                        <th class="uk-text-center blanco">Cantidad</th>
                        <th class="uk-text-center blanco">Precio Unitario</th>
                        <th class="uk-text-center blanco">Precio Total</th>
                    </tr>
                </thead>
                <tbody>
                @foreach($detalles['detalles_de_platos'] as $detapla)
                    <tr>
                        <td class="uk-text-center blanco">{{$detapla['plt_nom']}}</td>
                        <td class="uk-text-center blanco">{{$detapla['dtall_cant']}}</td>
                        <td class="uk-text-center blanco">{{$detapla['plt_pvp']}}</td>
                        <td class="uk-text-center blanco" >{{$detapla['dtall_valor']}}</td>
                    </tr>
                @endforeach

                </tbody>
                <tr class="uk-text-center blanco">
                    <td ></td>
                    <td></td>
                    <td></td>
                    <td>

                        <div>
                            <div class="uk-card uk-card-default uk-card-body content">Sub total: {{ $subtotal }}</div>
                            <div class="uk-card uk-card-default uk-card-body content">Iva: {{ $vistaiva }}%</div>
                            <div class="uk-card uk-card-default uk-card-body content">Total: {{ $var }}</div>
                        </div>


                    </td>
                </tr>

        </table>


</div>
<br>
<div class="uk-animation-toggle" tabindex="0">
<a class="uk-button uk-button-default content" href="/mesaofactura">Volver</a>
                {!! Form::open(['route'=> 'variablesfactura', 'method'=> 'POST']) !!}
                            {{ Form::hidden('idPedido', "$idPedido" )}}
                            {{ Form::hidden('idFac', "$idFac") }}
                            <button type="submit" class="uk-button uk-button-primary content">
                                Imprimir
                            </button>
                {!! Form::close() !!}





</div>

<br>





 master

</body>
</html> 

