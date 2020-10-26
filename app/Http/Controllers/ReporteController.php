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
        $lol=$request->lol;
        $keys=$request->keys;
        return Excel::download(new ReporteExport($lol, $keys), 'Reporte.xlsx');
    }
    
    public function crearReporte(Request $request)
    {       
        
        $fecha=$request->fecha;//almacena la fecha que envia el usuario
        $client = new Client ([
            'base_uri'=>'https://sgo-central-6to.herokuapp.com',
        //'timeout'=> 2.0,// tiempo a esperar por una respuesta
        ]);

            $todasfacs = $client->request('GET', "/api/facs");//solicita todas las facturas
            $todas=json_decode($todasfacs->getBody()->getContents(), true);//se pone todas las facturas en un array
            $todas = $todas['data:'];//se obtiene solo el array de datos            

            $todasout = [];

            //--------------------------------------------------------------
            //$givenDate = "2020-10-10";
            $givenDate = $fecha;
            //$dateMinusOneWeek = Carbon::parse($givenDate)->subWeek()->format('Y-m-d');            
            $datePlusOneWeek = Carbon::parse($givenDate)->addWeek()->format('Y-m-d');

            $period = CarbonPeriod::create($givenDate , $datePlusOneWeek);          
            
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

            //Obtiene todos los datos de las facturas de una fecha de todaout2
            foreach($todasout as $ele) 
            foreach($ele as $element)
            {
                $auxi = $client->request('GET', "/api/facs/{$element['id']}"); //llamada por id a cada factura 
                $auxide=json_decode($auxi->getBody()->getContents(), true);   
                $todatos[$i]=$auxide;  //se almacena cada factura en una posición del arreglo
                $i++;               
            }     
            
            //obtiene el nombre y la cantidad de todos los detalles en las facturas
            $Detalle = [];  
            $j=0;
            
            foreach($todatos as $element)
                foreach($element['detalles_de_platos'] as $element1)
                {   
                    $Detalle[] = ['fct_fch' =>$element['data']['fct_fch'], 'plt_nom' => $element1['plt_nom'],'dtall_cant' => $element1['dtall_cant']+0, 'plt_pvp'=> $element1['plt_pvp']+0];                                   
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
                    foreach($element['detalles_de_platos'] as $element1)
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
     
            
        return view('Reporte', compact('lol', 'keys', 'agrupGraf', 'dates')); 
    }
    
}
