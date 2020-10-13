<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use GuzzleHttp\Client;
class BuscarFacturaController extends Controller
{


    public function index()
    {
        return view('buscarfactura');
    }

    public function find(Request $request)
    {
       $idFac=$request->idFac;//extraemos el id que nos llega al buscar una factura
       $iva=0.12;//iva funcional del controlador
       $vistaiva=12;//iva para mostrar en la vista //probando gitHub


      try

       {
            $client = new Client ([
                'base_uri'=>'https://sgo-central-6to.herokuapp.com',
            //'timeout'=> 2.0,// tiempo a esperar por una respuesta

            ]);

                $response = $client->request('GET', "/api/facs/{$idFac}");//añadimos el número que extraímos a la ruta api/facs/{númeroExtarido}
                $responsedeta = $client->request('GET', "/api/facs/{$idFac}");//hacemos otra llamada con la misma petición

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
                $totalconiva=$var*$iva;
                //restamos el total menos el iva
                $subtotaliva=$var-$totalconiva;
                $subtotal=\number_format($subtotaliva, 2);

                return view('Factura', compact('facs', 'detalles', 'var', 'vistaiva', 'subtotal')); //pasamos cada valor a la vista Factura


        } catch(guzzlehttp \ guzzle \ src \ Exception \ RequestException $e)
        {
            return "No se encuentrá la factura" . $e->getmessage();

        }



    }


}
