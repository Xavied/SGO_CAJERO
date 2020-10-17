<html>
    <head>
        <style>
            .header{background:#eee;color:#444;border-bottom:1px solid #ddd;padding:10px;}
            .client-detail{background:#ddd;padding:10px;}
            .client-detail th{text-align:left;}
            .items{border-spacing:0;}
            .items thead{background:#ddd;}
            .items tbody{background:#eee;}
            .items tfoot{background:#ddd;}
            .items th{padding:10px;}
            .items td{padding:10px;}
            h1 small{display:block;font-size:16px;color:#888;}
            table{width:100%;}
            .text-right{text-align:right;}
        </style>
    </head>
    <body>

    <div class="header">
        <h1>
        Comprobante # {{ str_pad ($facs->data->id, 7, '0', STR_PAD_LEFT) }}

        </h1>
    </div>
    <table class="client-detail">
        <tr>
            <th style="width:100px;">
               Nombre 
            </th>
            <td>{{$facs->cliente->cli_nom }}</td>
        </tr>
        <tr>
            <th>Ruc</th>
            <td>{{$facs->cliente->cli_ci }}</td>
        </tr>
      
        <tr>
            <th>Telefono</th>
            <td>{{$facs->cliente->cli_telf }}</td>
        </tr>
    </table>

    <hr />

    <table class="items">
        <thead>
            <tr>
                <th class="text-left" style="width:15px;" >Cantidad</th>
                <th class="text-left" style="width:100px;">Producto</th>
                <th class="text-right" style="width:100px;">P.U</th>
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
        <tfoot>
        <tr>
            <td colspan="3" class="text-right"><b>IVA</b></td>
            <td class="text-right"> {{ $vistaiva }}%</td>
        </tr>
        <tr>
            <td colspan="3" class="text-right"><b>Sub Total</b></td>
            <td class="text-right">{{ $subtotal }}</td>
        </tr>
        <tr>
            <td colspan="3" class="text-right"><b>Total</b></td>
            <td class="text-right">{{ $var }}</td>
        </tr>
        </tfoot>
    </table>
    </body>
</html>