<?php

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
        $PlatoNombre=$request->PlatoNombre;
        $keys=$request->keys;
        return Excel::download(new ReporteExport($PlatoNombre, $keys), 'Reporte.xlsx');
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
            $facs = $client->request('GET', "/api/facs");//solicita todas las facturas
            $todasfacs=json_decode($facs->getBody()->getContents(), true);//pone todas las facturas en un array
            $todasfacs = $todasfacs['data:'];//obtiene solo el array de datos           
            

            //Genera un array desde la fecha solicitada más una semana
            $datePlusOneWeek = Carbon::parse($fecha)->addWeek()->format('Y-m-d');
            $period = CarbonPeriod::create($fecha , $datePlusOneWeek);
            //Genera un array con las fechas con el formato 'Y-m-d'
            $dates = array();
            foreach ($period as $date) {
                    $dates[] = $date->format('Y-m-d');
                }            

            //Obtiene los ids de las facturas generadas en esas fechas
            $fechasid = array();
            foreach($dates as $date)
                foreach($todasfacs as $fac)
                {
                    if($fac['fct_fch']==$date)
                    {
                        $fechasid[$fac['fct_fch']][] = ['id' => $fac['id']];
                    }
                }
            //if el arreglo esta vacio no hay facturas en esas fechas!!--!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!                           

            //Obtiene todos los datos de las facturas existentes en las fechas seleccionadas
            $DatosFacs = []; //Datos de las facturas seleccionadas
            $i=0;
            foreach($fechasid as $fecha)
                foreach($fecha as $idfac) 
                {
                    $aux = $client->request('GET', "/api/facsplatos/{$idfac['id']}");
                    $auxde=json_decode($aux->getBody()->getContents(), true);
                    $DatosFacs[$i]=$auxde;  //se almacena cada factura en una posición del arreglo
                    $i++;
                }
                
            //Organiza cada detalle con su fecha correspondiente en la posición de un arreglo
            $DetalleFecha = [];
            $j=0;
            foreach($DatosFacs as $Factura)
                foreach($Factura['platos_detalle'] as $Detalle)
                {
                    $DetalleFecha[] = ['fct_fch' =>$Factura['factura'][0]['fct_fch'], 'plt_nom' => $Detalle['plt_nom'], 'plt_pvp' => $Detalle['plt_pvp'],'plt_tipo' => $Detalle['plt_tipo'],'dtall_cant' => $Detalle['dtall_cant']+0, 'dtall_valor'=> $Detalle['dtall_valor']+0];
                }         

            #region Reporte por NOMBRE de plato-------------------------------------------------------
            //Agrupa los valores por fecha y nombre (para el reporte por nombre de plato)
            $out = array();            

            foreach ($DetalleFecha as $row) {
                if(! isset($out[$row['fct_fch']][$row['plt_nom']])) {
                    $out[$row['fct_fch']][$row['plt_nom']][0]=0;
                    $out[$row['fct_fch']][$row['plt_nom']][1]=0;
                }
                $out[$row['fct_fch']][$row['plt_nom']][0] += $row['dtall_cant'];
                $out[$row['fct_fch']][$row['plt_nom']][1] +=$row['dtall_valor'];
            } 

            //Generación del array para gráfico de pastel y barras
            $GrafNom = array();
            $GrafNom2 = array();
            foreach ($DetalleFecha as $row) {
                if(! isset($GrafNom[$row['plt_nom']])) {
                    $GrafNom[$row['plt_nom']][1]=0;
                }
                $GrafNom[$row['plt_nom']][0] = $row['plt_nom'];
                $GrafNom[$row['plt_nom']][1] += $row['dtall_cant'];
            }            
            $k=0;
            foreach($GrafNom as $p)
            {
                $GrafNom2[$k][0] = $p[0];
                $GrafNom2[$k][1] = $p[1];
                $k++;
            }

            //Asigna un key a cada valor (para el reporte por nombre de plato)
            $out2 = array();
            foreach($out as $fct_fch => $fct_fch_array) {
                foreach($fct_fch_array as $plt_nom => $plt_nom_array){
                    $out2[] = array('fct_fch' => $fct_fch, 'plt_nom' => $plt_nom, 'dtall_cant' => $plt_nom_array[0], 'dtall_valor'=> $plt_nom_array[1] );
                }
            }
            
            //Agrupa todos los detalles de una fecha en una posición de array (para el reporte por nombre de plato)
            $PlatoNombre=array();
            foreach($out2 as $element1)
            {
                $PlatoNombre[$element1['fct_fch']][] = $element1;
            }
            //Keys del arreglo para obtener todas las fechas en las que se han ingresado facturas (para el reporte por nombre de plato)
            $keys = array_keys($PlatoNombre);
            #endregion ---------------------------------------------------------------------------------------
            
            #region Reporte por TIPO de plato --------------------------------------------------------
            //Agrupa los valores por fecha y nombre (para el reporte por TIPO de plato)
            $TiPlt = array();
            foreach ($DetalleFecha as $row) {
                if(! isset($TiPlt[$row['fct_fch']][$row['plt_tipo']])) {
                    $TiPlt[$row['fct_fch']][$row['plt_tipo']][0]=0;
                    $TiPlt[$row['fct_fch']][$row['plt_tipo']][1]=0;
                }
                $TiPlt[$row['fct_fch']][$row['plt_tipo']][0] += $row['dtall_cant'];
                $TiPlt[$row['fct_fch']][$row['plt_tipo']][1] += $row['dtall_valor'];
            } 

            //Generación del array para gráfico de pastel y barras
            $GrafTipo = array();
            $GrafTipo2 = array();
            foreach ($DetalleFecha as $row) {
                if(! isset($GrafTipo[$row['plt_tipo']])) {
                    $GrafTipo[$row['plt_tipo']][1]=0;
                }
                $GrafTipo[$row['plt_tipo']][0] = $row['plt_tipo'];
                $GrafTipo[$row['plt_tipo']][1] += $row['dtall_cant'];
            }            
            $k=0;
            foreach($GrafTipo as $p)
            {
                $GrafTipo2[$k][0] = $p[0];
                $GrafTipo2[$k][1] = $p[1];
                $k++;
            }

            //Asigna un key a cada valor (para el reporte por TIPO de plato)
            $TiPlt2 = array();
            foreach($TiPlt as $fct_fch => $fct_fch_array) {
                foreach($fct_fch_array as $plt_tipo => $plt_tipo_array){
                    $TiPlt2[] = array('fct_fch' => $fct_fch, 'plt_tipo' => $plt_tipo, 'dtall_cant' => $plt_tipo_array[0], 'dtall_valor'=> $plt_tipo_array[1] );
                }
            }            
            //Agrupa todos los detalles de una fecha en una posición de array (para el reporte por TIPO de plato)
            $PlatoTipo=array();
            foreach($TiPlt2 as $element1)
            {
                $PlatoTipo[$element1['fct_fch']][] = $element1;
            }
            #endregion
           

            


        return view('Reporte', compact('dates', 'PlatoNombre', 'keys', 'PlatoTipo', 'GrafNom2', 'GrafTipo2', 'DetalleFecha'));
    }

}
