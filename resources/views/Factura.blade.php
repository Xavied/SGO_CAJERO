<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <!-- UIkit CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/uikit@3.4.6/dist/css/uikit.min.css" />
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


                                </td>




                            </tr>


                        <tr>
                                <td>

                                    <div>
                                        <div class="uk-card uk-card-small uk-card-body blanco">Nombre del Cliente:    <span class="uk-label content">{{$facs->cliente->cli_nom }}</span></div>
                                    </div>

                                </td>


                        </tr>
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
<a class="uk-button uk-button-default content" href="{{"/imprimir/$idFac"}}">Imprimir</a>


</div>

<br>








</body>
</html>
