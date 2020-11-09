<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use GuzzleHttp\Client;
use GuzzleHttp\Exception\ClientException;

class autController extends Controller
{
    public function ingresar(Request $request)
    {       $this->validate($request, [
            'email' => 'required',
            'password' => 'required|numeric'
        ]);
        $credentials= $request->only('email', 'password');

       try
       {
                $client = new Client([
                    'base_uri'=>'https://sgo-central-6to.herokuapp.com',
                //'timeout'=> 2.0,// tiempo a esperar por una respuesta

                ]);
            $response = $client->request('POST', "/api/login",
                [
                    'form_params'=> $credentials

                ]);

            $data=json_decode($response->getBody());

            $data=$data->message;

            if($data='Bienvenido')
            {
                return \view('cajero');
            }
        }
        catch(ClientException $e)
        {
           return 'Error al autenticarse';

        }


    }

}
