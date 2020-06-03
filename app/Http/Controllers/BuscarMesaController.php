<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use GuzzleHttp\Client;



class BuscarMesaController extends Controller
{
    public function index()
    {
        return view('buscarmesa');
    }

    public function find(Request $request)
    {
            $idMesa=$request->idMesa;//extraemos el id que nos llega al buscar una Mesa

            $client = new Client ([
                'base_uri'=>'https://safe-bastion-34410.herokuapp.com',
            //'timeout'=> 2.0,// tiempo a esperar por una respuesta

            ]);

                $response = $client->request('GET', "/api/mesas/{$idMesa}");//añadimos el número que extraímos a la ruta api/mesas/{númeroExtarido}
                $responsedeta = $client->request('GET', "/api/mesas/{$idMesa}");//hacemos otra llamada con la misma petición

                $mesas= json_decode($response->getBody()->getContents());//extraemos el contenido de mesas
                $detalles=json_decode($responsedeta->getBody()->getContents(), true);//array del json

            // $detales=$detalles['clientes'];//array de clientes
                //$longitud= count($detales);


        if($detalles['status']==200)
        {
             return view('sinpedidos');
        }
        else
         {


                if($detalles['pedidos']!=null)
                {
                 return view('Mesa', compact( 'detalles'));
                }else
                {
                    return  view('sincliente');
                }
            }




    }



}
