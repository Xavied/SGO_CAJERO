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
        $token= 'Bearer eyJ0eXAiOiJKV1QiLCJhbGciOiJSUzI1NiJ9.eyJhdWQiOiI1IiwianRpIjoiNTQyZWRlNWNhZjY1YjM4MGE3MDMyMjIxZjM1NmY4YTQxYjQwY2U3MGU3MDNmYTRiNzViYjk4ZmY0OWVjMDU0NTgwYThiY2I1ODQyMzEyYjkiLCJpYXQiOjE2MDMwNTk4ODYsIm5iZiI6MTYwMzA1OTg4NiwiZXhwIjoxNjM0NTk1ODg1LCJzdWIiOiI0Iiwic2NvcGVzIjpbXX0.VWEVXyX2sH6N9jmbdLeIpkgu1zOGWbS8E9UwEca34ic4j8HsgpN02O99p-cksj37b34Fa8Usf_LAjWRPPLPcQOutZVFKIjrIFgHrQsFDPrgNZHvlEz_DPpQXsvi-XDwFm7wC1pKXwKbQfG8M70RAH-iznlzATff7XMhYC9woWwOlA_YaIonJ8T9UAVGvpcM7Kwa0ck2-sznXeV9GSAjsvM6pGzONmxCQER5UDTCSv8zXmjmNB8U-_x4kRp4IZyaOkdlAFAXo6-60d_ZanduaqfmIYG_W4JF-JbLdUBl6uZRgBSy1KS9yyaYiP7hZb82foTuJbMed8txnOPErMNitSswMKduzduUzAU4XKGn7b4YnnSKfMHVIhNKCGj25vehaFPnvW8N_9mk1I2PdGxq5kRdVGzq9mYtahNR3D17rrvneDW5ECSp7haYhkVVOBnioBo4MmdTyGUdh0e76Y6oieu0v83dKUqXQULG6i8J107KHL0d7yKO2nRfY-ru-F7vknJlsfQtj2jMcZXxK3-Uq3xJrrcUKKsFted9o5iRlJh5af8JEqkal1bbpaKRQAlTYa3JvcNbsMmtDgQjYcK7mxYRU2tKzuf0P1UVh9pJiMH0t3VdaZj3tlPEGKI1BvfZLbB7LV_Y_pVPWgBbn4Ilj8oYuZnTNE0uYbqE13WNBSXI';
        $client = new Client ([
            'base_uri'=>'https://sgo-central-6to.herokuapp.com',
        //'timeout'=> 2.0,// tiempo a esperar por una respuesta
            'headers'=>['Authorization'=> $token]

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
