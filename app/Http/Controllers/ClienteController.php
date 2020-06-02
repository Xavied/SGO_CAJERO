<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use GuzzleHttp\Client;

class ClienteController extends Controller
{
    private $cliente;
    public function __construct()
    {
        $this->cliente=new Client(['base_uri'=>'https://safe-bastion-34410.herokuapp.com/',]);

    }



    public function index()
    {
        $idCliente=1;
      $response=$this->cliente->get("api/clientes/$idCliente");
      $ver=json_decode($response->getbody());
        $ver=[$ver->data->id,
        $ver->data->cli_ci,
        $ver->data->cli_nom


    ];

      //return view('crearcliente');
      return dd($ver);

    }

    public function enviar(Request $request)
    {

    }

}
