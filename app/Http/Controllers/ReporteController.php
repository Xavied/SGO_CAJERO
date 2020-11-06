cdcd<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use GuzzleHttp\Client;
use Carbon\Carbon;
use Carbon\CarbonPeriod;
use Maatwebsite\Excel\Facades\Excel;
use App\Exports\ReporteExport;

class ReporteController extends Controller
{
    public function form()
    {
        return view('solicReporte');
    }

    public function excel(Request $request)
    {
        $lol=$request->lol;
        $keys=$request->keys;
        return Excel::download(new ReporteExport($lol, $keys), 'Reporte.xlsx');
    }

    public function crearReporte(Request $request)
    {

        $fecha=$request->fecha;//almacena la fecha que envia el usuario
        $token= 'Bearer eyJ0eXAiOiJKV1QiLCJhbGciOiJSUzI1NiJ9.eyJhdWQiOiI1IiwianRpIjoiNTQyZWRlNWNhZjY1YjM4MGE3MDMyMjIxZjM1NmY4YTQxYjQwY2U3MGU3MDNmYTRiNzViYjk4ZmY0OWVjMDU0NTgwYThiY2I1ODQyMzEyYjkiLCJpYXQiOjE2MDMwNTk4ODYsIm5iZiI6MTYwMzA1OTg4NiwiZXhwIjoxNjM0NTk1ODg1LCJzdWIiOiI0Iiwic2NvcGVzIjpbXX0.VWEVXyX2sH6N9jmbdLeIpkgu1zOGWbS8E9UwEca34ic4j8HsgpN02O99p-cksj37b34Fa8Usf_LAjWRPPLPcQOutZVFKIjrIFgHrQsFDPrgNZHvlEz_DPpQXsvi-XDwFm7wC1pKXwKbQfG8M70RAH-iznlzATff7XMhYC9woWwOlA_YaIonJ8T9UAVGvpcM7Kwa0ck2-sznXeV9GSAjsvM6pGzONmxCQER5UDTCSv8zXmjmNB8U-_x4kRp4IZyaOkdlAFAXo6-60d_ZanduaqfmIYG_W4JF-JbLdUBl6uZRgBSy1KS9yyaYiP7hZb82foTuJbMed8txnOPErMNitSswMKduzduUzAU4XKGn7b4YnnSKfMHVIhNKCGj25vehaFPnvW8N_9mk1I2PdGxq5kRdVGzq9mYtahNR3D17rrvneDW5ECSp7haYhkVVOBnioBo4MmdTyGUdh0e76Y6oieu0v83dKUqXQULG6i8J107KHL0d7yKO2nRfY-ru-F7vknJlsfQtj2jMcZXxK3-Uq3xJrrcUKKsFted9o5iRlJh5af8JEqkal1bbpaKRQAlTYa3JvcNbsMmtDgQjYcK7mxYRU2tKzuf0P1UVh9pJiMH0t3VdaZj3tlPEGKI1BvfZLbB7LV_Y_pVPWgBbn4Ilj8oYuZnTNE0uYbqE13WNBSXI';
        $client = new Client ([
            'base_uri'=>'https://sgo-central-6to.herokuapp.com',
        //'timeout'=> 2.0,// tiempo a esperar por una respuesta
            'headers'=>['Authorization'=> $token]

        ]);
            $todasfacs = $client->request('GET', "/api/facs");//solicita todas las facturas
            $todas=json_decode($todasfacs->getBody()->getContents(), true);//se pone todas las facturas en un array
            $todas = $todas['data:'];//se obtiene solo el array de datos

            $todasout = [];

            //--------------------------------------------------------------
            //$dateMinusOneWeek = Carbon::parse($givenDate)->subWeek()->format('Y-m-d');
            $datePlusOneWeek = Carbon::parse($fecha)->addWeek()->format('Y-m-d');
            $period = CarbonPeriod::create($fecha , $datePlusOneWeek);
            //Genera un array con las fechas generadas
            $dates = array();
            foreach ($period as $date) {
                    $dates[] = $date->format('Y-m-d');
                }

            //Obtiene los ids de las facturas generadas en esas fechas
            foreach($dates as $date)
                foreach($todas as $element)
                {
                    if($element['fct_fch']==$date)
                    {
                        $todasout[$element['fct_fch']][] = ['id' => $element['id']];
                    }
                }

            $todatos = [];
            $i=0;

            //prueba-------------------------------------------------------------
            // $auxi = $client->request('GET', "/api/facsplatos/1"); 
            // $auxide=json_decode($auxi->getBody()->getContents(), true);
            // return $auxide;
            //end prueba---------------------------------------------------------

            //Obtiene todos los datos de las facturas de una fecha de todaout2
            foreach($todasout as $ele)
            foreach($ele as $element) 
            {
                //$auxi = $client->request('GET', "/api/facs/{$element['id']}"); //llamada por id a cada factura
                $auxi = $client->request('GET', "/api/facsplatos/{$element['id']}");//CAMBIO!!!----
                $auxide=json_decode($auxi->getBody()->getContents(), true);
                $todatos[$i]=$auxide;  //se almacena cada factura en una posición del arreglo
                $i++;
            }

            //obtiene el nombre y la cantidad de todos los detalles en las facturas
            $Detalle = [];
            $j=0;

            foreach($todatos as $element)
                //foreach($element['detalles_de_platos'] as $element1)
                foreach($element['platos_detalle'] as $element1)//CAMBIO!!----
                {
                    //$Detalle[] = ['fct_fch' =>$element['data']['fct_fch'], 'plt_nom' => $element1['plt_nom'],'dtall_cant' => $element1['dtall_cant']+0, 'plt_pvp'=> $element1['plt_pvp']+0];
                    //CAMBIO!!--
                    $Detalle[] = ['fct_fch' =>$element['factura'][0]['fct_fch'], 'plt_nom' => $element1['plt_nom'], 'plt_tipo' => $element1['plt_tipo'],'dtall_cant' => $element1['dtall_cant']+0, 'plt_pvp'=> $element1['plt_pvp']+0];
                }

                

            $out = array();
            foreach ($Detalle as $row) {
                if(! isset($out[$row['fct_fch']][$row['plt_nom']][$row['plt_pvp']])) {
                    $out[$row['fct_fch']][$row['plt_nom']][$row['plt_pvp']]=0;
                }
                $out[$row['fct_fch']][$row['plt_nom']][$row['plt_pvp']] += $row['dtall_cant'];
            }

            $out2 = array();
            foreach($out as $fct_fch => $fct_fch_array) {
                foreach($fct_fch_array as $plt_nom => $plt_nom_array){
                    foreach($plt_nom_array as $plt_pvp => $dtall_cant){
                    $out2[] = array('fct_fch' => $fct_fch, 'plt_nom' => $plt_nom, 'plt_pvp'=> $plt_pvp, 'dtall_cant' => $dtall_cant);
                    }
                }
            }

            //Tipo de platos----------------------------------------------------------------------
            $TiPlt = array();
            foreach ($Detalle as $row) {
                if(! isset($TiPlt[$row['fct_fch']][$row['plt_tipo']][$row['plt_pvp']])) {
                    $TiPlt[$row['fct_fch']][$row['plt_tipo']][$row['plt_pvp']]=0;
                }
                $TiPlt[$row['fct_fch']][$row['plt_tipo']][$row['plt_pvp']] += $row['dtall_cant'];
            }

            $TiPlt2 = array();
            foreach($TiPlt as $fct_fch => $fct_fch_array) {
                foreach($fct_fch_array as $plt_tipo => $plt_tipo_array){
                    foreach($plt_tipo_array as $plt_pvp => $dtall_cant){
                    $TiPlt2[] = array('fct_fch' => $fct_fch, 'plt_tipo' => $plt_tipo, 'plt_pvp'=> $plt_pvp, 'dtall_cant' => $dtall_cant);
                    }
                }
            }

            $TiPlt3=array();
            foreach($TiPlt2 as $element1)
            {
                $TiPlt3[$element1['fct_fch']][] = $element1;
            }

            $keysTP = array_keys($TiPlt3);
            //end tipo de platos---------------------------------------------------------

            //prueba-------------------------------------------------------------
            //return $TiPlt2;
            //end prueba---------------------------------------------------------

            $lol=array();
            foreach($out2 as $element1)
            {
                $lol[$element1['fct_fch']][] = $element1;
            }

            $keys = array_keys($lol);

            #region Arreglos para Gráficos
                //obtiene el nombre y la cantidad de todos los detalles en las facturas
                $DetalleGraf = [];
                foreach($todatos as $element)
                    //foreach($element['detalles_de_platos'] as $element1)
                    foreach($element['platos_detalle'] as $element1)//CAMBIO!!----
                    {
                        $DetalleGraf[$element1['plt_nom']][] = ['plt_nom' => $element1['plt_nom'],'dtall_cant' => $element1['dtall_cant']+0];
                    }

                $agrupGraf = [];
                $j=0;
                $l=0;
                //Nombre y cantidad de los platos pero agrupados
                foreach($DetalleGraf as $element2)
                    {
                        foreach($element2 as $element1)
                        {
                            $agrupGraf[$j][0]= $element1['plt_nom'];
                            $l+=$element1['dtall_cant'];
                            $agrupGraf[$j][1] = $l;
                        }
                        $l=0;
                        $j++;
                    }
            #endregion


        return view('Reporte', compact('lol', 'keys', 'agrupGraf', 'dates', 'TiPlt3', 'keysTP'));
    }

}
