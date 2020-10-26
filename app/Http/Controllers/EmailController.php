<?php

namespace App\Http\Controllers;
use GuzzleHttp\Client;
use Illuminate\Http\Request;
use Mail;

class EmailController extends Controller
{

    public function index()
    {
        return \view('Administrator.mails.test');

    }
    public function contact(Request $request)
    {
        //dd($request);
        $client = new Client ([
            'base_uri'=>'https://sgo-central-6to.herokuapp.com',
        //'timeout'=> 2.0,// tiempo a esperar por una respuesta

        ]);

            $response = $client->request('GET', "/api/clientes");//añadimos el número que extraímos a la ruta api/facs/{númeroExtarido}
            $clientes=json_decode($response->getBody()->getContents(), true);

            //imiciamos el array de los correos
            $arraycorreos=null;
                    //eliminar los : de data (data:)->'data' cuando se haga un deploy en la api
            //iniciamos un contador para guardar los correos en el array correos
            $i=0;
            //sacamos el correo de los todos los clientes que nos muestre la apí
            foreach($clientes['data:'] as $correos)
            {
                $arraycorreos[$i] = $correos['cli_email'];
                $i++;
            }


        $subject = "Promoción de los platos SGO";
        $for = $arraycorreos;
        Mail::send('Administrator.mails.email',$request->all(), function($mensaje) use($subject,$for){
            $mensaje->from("nanosoft101aa@gmail.com","Restaurante-(Sistema Sgo)");
            $mensaje->subject($subject);
            $mensaje->to($for);
        });
        return redirect()->back();

    }
}
