<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use GuzzleHttp\Client;

class ReporteFacsController extends Controller
{
    public function __construct(){
        $this->middleware('auth');
    }
    public function FacturaInd(Request $request)
    {
        
        $DatosFac = json_decode($request->Datos, true);
        $Fecha = $DatosFac['data']['fct_fch']; 
        //return $DatosFac;

        $detales=$DatosFac['detalles_de_platos'];//nos concentramos en el array de detalles de platos

        $vistaiva=0.12;
        $var=0;

        foreach($detales as $det)
        {
            $var+=$det['dtall_valor'];
        }                
                
        $subtotal=\number_format($var/1.12, 2);
        $IVA = \number_format($subtotal* $vistaiva, 2);
        $total = \number_format($var, 2);

        return view('ReporteFacInd', compact('DatosFac', 'subtotal', 'IVA', 'total', 'Fecha'));       
    }

    public function crearReporte(Request $request)
    {

        $fechaR=$request->fecha;//almacena la fecha que envia el usuario
        $token= 'Bearer eyJ0eXAiOiJKV1QiLCJhbGciOiJSUzI1NiJ9.eyJhdWQiOiI1IiwianRpIjoiNTQyZWRlNWNhZjY1YjM4MGE3MDMyMjIxZjM1NmY4YTQxYjQwY2U3MGU3MDNmYTRiNzViYjk4ZmY0OWVjMDU0NTgwYThiY2I1ODQyMzEyYjkiLCJpYXQiOjE2MDMwNTk4ODYsIm5iZiI6MTYwMzA1OTg4NiwiZXhwIjoxNjM0NTk1ODg1LCJzdWIiOiI0Iiwic2NvcGVzIjpbXX0.VWEVXyX2sH6N9jmbdLeIpkgu1zOGWbS8E9UwEca34ic4j8HsgpN02O99p-cksj37b34Fa8Usf_LAjWRPPLPcQOutZVFKIjrIFgHrQsFDPrgNZHvlEz_DPpQXsvi-XDwFm7wC1pKXwKbQfG8M70RAH-iznlzATff7XMhYC9woWwOlA_YaIonJ8T9UAVGvpcM7Kwa0ck2-sznXeV9GSAjsvM6pGzONmxCQER5UDTCSv8zXmjmNB8U-_x4kRp4IZyaOkdlAFAXo6-60d_ZanduaqfmIYG_W4JF-JbLdUBl6uZRgBSy1KS9yyaYiP7hZb82foTuJbMed8txnOPErMNitSswMKduzduUzAU4XKGn7b4YnnSKfMHVIhNKCGj25vehaFPnvW8N_9mk1I2PdGxq5kRdVGzq9mYtahNR3D17rrvneDW5ECSp7haYhkVVOBnioBo4MmdTyGUdh0e76Y6oieu0v83dKUqXQULG6i8J107KHL0d7yKO2nRfY-ru-F7vknJlsfQtj2jMcZXxK3-Uq3xJrrcUKKsFted9o5iRlJh5af8JEqkal1bbpaKRQAlTYa3JvcNbsMmtDgQjYcK7mxYRU2tKzuf0P1UVh9pJiMH0t3VdaZj3tlPEGKI1BvfZLbB7LV_Y_pVPWgBbn4Ilj8oYuZnTNE0uYbqE13WNBSXI';
        $client = new Client ([
            'base_uri'=>'https://sgo-central-6to.herokuapp.com',
        //'timeout'=> 2.0,// tiempo a esperar por una respuesta
            'headers'=>['Authorization'=> $token]

        ]);
            $facs = $client->request('GET', "/api/facs");//solicita todas las facturas
            $todasfacs=json_decode($facs->getBody()->getContents(), true);//pone todas las facturas en un array
            $todasfacs = $todasfacs['data:'];//obtiene solo el array de datos 

            //Obtiene los ids de las facturas generadas en esas fechas
            $fechasid = array();
            foreach($todasfacs as $fac)
            {
                if($fac['fct_fch']==$fechaR)
                {
                    $fechasid[$fac['fct_fch']][] = ['id' => $fac['id']];
                }
            }
            
            //Si el arreglo fechasid está vacío no se han generado facturas en esa semana                           
            if(count($fechasid)==0)
            {
                $MensajeError = '';
                $MensajeErrorFacs = "No se ha generado ninguna factura en la fecha solicitada ({$fechaR}), intente de nuevo con otra fecha";
                return view('solicReporte', compact('MensajeError', 'MensajeErrorFacs'));
            }
            else
            {                        

                //Obtiene todos los datos de las facturas existentes en las fechas seleccionadas
                $DatosFacs = []; //Datos de las facturas seleccionadas
                $i=0;
                foreach($fechasid as $fecha)
                {
                    foreach($fecha as $idfac) 
                    {
                        $aux = $client->request('GET', "/api/facs/{$idfac['id']}");
                        $auxde=json_decode($aux->getBody()->getContents(), true);
                        $DatosFacs[$i]=$auxde;  //se almacena cada factura en una posición del arreglo
                        $i++;
                    }
                }
                //return $DatosFacs;
                return view('ReporteFacs', compact('DatosFacs', 'fechaR'));
            }
    }
}
