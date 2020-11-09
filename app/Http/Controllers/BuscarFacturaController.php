<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use GuzzleHttp\Client;
use GuzzleHttp\Psr7;
use GuzzleHttp\Exception\ClientException;

class BuscarFacturaController extends Controller
{


    public function verfacturas(Request $request)
    {

        try
        {
            $cedula_cli=$request->cli_cedula;
            $token= 'Bearer eyJ0eXAiOiJKV1QiLCJhbGciOiJSUzI1NiJ9.eyJhdWQiOiI1IiwianRpIjoiNTQyZWRlNWNhZjY1YjM4MGE3MDMyMjIxZjM1NmY4YTQxYjQwY2U3MGU3MDNmYTRiNzViYjk4ZmY0OWVjMDU0NTgwYThiY2I1ODQyMzEyYjkiLCJpYXQiOjE2MDMwNTk4ODYsIm5iZiI6MTYwMzA1OTg4NiwiZXhwIjoxNjM0NTk1ODg1LCJzdWIiOiI0Iiwic2NvcGVzIjpbXX0.VWEVXyX2sH6N9jmbdLeIpkgu1zOGWbS8E9UwEca34ic4j8HsgpN02O99p-cksj37b34Fa8Usf_LAjWRPPLPcQOutZVFKIjrIFgHrQsFDPrgNZHvlEz_DPpQXsvi-XDwFm7wC1pKXwKbQfG8M70RAH-iznlzATff7XMhYC9woWwOlA_YaIonJ8T9UAVGvpcM7Kwa0ck2-sznXeV9GSAjsvM6pGzONmxCQER5UDTCSv8zXmjmNB8U-_x4kRp4IZyaOkdlAFAXo6-60d_ZanduaqfmIYG_W4JF-JbLdUBl6uZRgBSy1KS9yyaYiP7hZb82foTuJbMed8txnOPErMNitSswMKduzduUzAU4XKGn7b4YnnSKfMHVIhNKCGj25vehaFPnvW8N_9mk1I2PdGxq5kRdVGzq9mYtahNR3D17rrvneDW5ECSp7haYhkVVOBnioBo4MmdTyGUdh0e76Y6oieu0v83dKUqXQULG6i8J107KHL0d7yKO2nRfY-ru-F7vknJlsfQtj2jMcZXxK3-Uq3xJrrcUKKsFted9o5iRlJh5af8JEqkal1bbpaKRQAlTYa3JvcNbsMmtDgQjYcK7mxYRU2tKzuf0P1UVh9pJiMH0t3VdaZj3tlPEGKI1BvfZLbB7LV_Y_pVPWgBbn4Ilj8oYuZnTNE0uYbqE13WNBSXI';
            $client = new Client ([
                'base_uri'=>'https://sgo-central-6to.herokuapp.com',
            //'timeout'=> 2.0,// tiempo a esperar por una respuesta
                'headers'=>['Authorization'=> $token]

            ]);
            $verf= $client->request('GET', "/api/cedulaclientes/$cedula_cli");

           $cliexist= json_decode($verf->getBody()->getContents());
           $response = $client->request('GET', "/api/clifacs/$cedula_cli");
           $response = $client->request('GET', "/api/clifacs/$cedula_cli");
           $facs =  json_decode($response->getBody()->getContents(), true);
            if($facs['factura_clientes']==null)
            {
            return  "No tiene facturas disponibles";
            }
            else
                $facs = $facs['factura_clientes'];
            return \view('webcajero.facturascliente', compact('facs'));

            //dd($facs);*/
        }catch(ClientException $e)
        {
            return "No hay un cliente con esa cédula";

        }




    }
    public function index()
    {
        return view('webcajero.buscarfactura');
    }



    public function find(Request $request)
    {
       $idFac=$request->idFac;//extraemos el id que nos llega al buscar una factura

       //$iva=0.12;//iva funcional del controlador
       $vistaiva=0.12;//iva para mostrar en la vista
       $idPedido=$request->idPedido;//extreamos el id del pedido que llega


      try

       {
            $token= 'Bearer eyJ0eXAiOiJKV1QiLCJhbGciOiJSUzI1NiJ9.eyJhdWQiOiI1IiwianRpIjoiNTQyZWRlNWNhZjY1YjM4MGE3MDMyMjIxZjM1NmY4YTQxYjQwY2U3MGU3MDNmYTRiNzViYjk4ZmY0OWVjMDU0NTgwYThiY2I1ODQyMzEyYjkiLCJpYXQiOjE2MDMwNTk4ODYsIm5iZiI6MTYwMzA1OTg4NiwiZXhwIjoxNjM0NTk1ODg1LCJzdWIiOiI0Iiwic2NvcGVzIjpbXX0.VWEVXyX2sH6N9jmbdLeIpkgu1zOGWbS8E9UwEca34ic4j8HsgpN02O99p-cksj37b34Fa8Usf_LAjWRPPLPcQOutZVFKIjrIFgHrQsFDPrgNZHvlEz_DPpQXsvi-XDwFm7wC1pKXwKbQfG8M70RAH-iznlzATff7XMhYC9woWwOlA_YaIonJ8T9UAVGvpcM7Kwa0ck2-sznXeV9GSAjsvM6pGzONmxCQER5UDTCSv8zXmjmNB8U-_x4kRp4IZyaOkdlAFAXo6-60d_ZanduaqfmIYG_W4JF-JbLdUBl6uZRgBSy1KS9yyaYiP7hZb82foTuJbMed8txnOPErMNitSswMKduzduUzAU4XKGn7b4YnnSKfMHVIhNKCGj25vehaFPnvW8N_9mk1I2PdGxq5kRdVGzq9mYtahNR3D17rrvneDW5ECSp7haYhkVVOBnioBo4MmdTyGUdh0e76Y6oieu0v83dKUqXQULG6i8J107KHL0d7yKO2nRfY-ru-F7vknJlsfQtj2jMcZXxK3-Uq3xJrrcUKKsFted9o5iRlJh5af8JEqkal1bbpaKRQAlTYa3JvcNbsMmtDgQjYcK7mxYRU2tKzuf0P1UVh9pJiMH0t3VdaZj3tlPEGKI1BvfZLbB7LV_Y_pVPWgBbn4Ilj8oYuZnTNE0uYbqE13WNBSXI';
            $client = new Client ([
                'base_uri'=>'https://sgo-central-6to.herokuapp.com',
            //'timeout'=> 2.0,// tiempo a esperar por una respuesta
                'headers'=>['Authorization'=> $token]

            ]);

                $response = $client->request('GET', "/api/facs/{$idFac}");//añadimos el número que extraímos a la ruta api/facs/{númeroExtarido}
                $responsedeta = $client->request('GET',"/api/facs/{$idFac}"); //hacemos otra llamada con la misma petición


                $facs= json_decode($response->getBody()->getContents());//extraemos el contenido de facs


                $detalles=json_decode($responsedeta->getBody()->getContents(), true);//array del json

                $detales=$detalles['detalles_de_platos'];//nos concentramos en el array de detalles de platos

                //vemos la longitud
                $longitud= count($detales);//vemos su longitud
                $var=0;

                for($i=0; $i<$longitud; $i++) //iteramos en el array
                {
                    $var+=$detales[$i]['dtall_valor']; //sumamos los valores de cada iteración

                }
                //calculamos el total del iva
               // $totalconiva=$var*$iva;
                //restamos el total menos el iva


                $subtotaliva=$var/1.12 ;
                $subtotal=\number_format($subtotaliva, 2);
                $IVA = $subtotal* $vistaiva;
                $IVA = \number_format($IVA,2);
                $total = $subtotal + $IVA;
                $total = \number_format($total,2);
               //$total = $vistaiva + $subtotaliva
                return view('webcajero.Factura', compact('facs', 'detalles', 'var', 'vistaiva', 'subtotal','idFac','IVA','total', 'idPedido')); //pasamos cada valor a la vista Factura





        } catch(guzzlehttp \ guzzle \ src \ Exception \ RequestException $e)
        {
            return "No se encuentrá la factura" . $e->getmessage();

        }



    }


}
