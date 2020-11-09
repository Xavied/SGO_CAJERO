<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use GuzzleHttp\Client;
use GuzzleHttp\Psr7;
use GuzzleHttp\Exception\ClientException;

class EmpleadoController extends Controller
{
    public function __construct(){
        $this->middleware('auth');
    } 
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $token= 'Bearer eyJ0eXAiOiJKV1QiLCJhbGciOiJSUzI1NiJ9.eyJhdWQiOiI1IiwianRpIjoiNTQyZWRlNWNhZjY1YjM4MGE3MDMyMjIxZjM1NmY4YTQxYjQwY2U3MGU3MDNmYTRiNzViYjk4ZmY0OWVjMDU0NTgwYThiY2I1ODQyMzEyYjkiLCJpYXQiOjE2MDMwNTk4ODYsIm5iZiI6MTYwMzA1OTg4NiwiZXhwIjoxNjM0NTk1ODg1LCJzdWIiOiI0Iiwic2NvcGVzIjpbXX0.VWEVXyX2sH6N9jmbdLeIpkgu1zOGWbS8E9UwEca34ic4j8HsgpN02O99p-cksj37b34Fa8Usf_LAjWRPPLPcQOutZVFKIjrIFgHrQsFDPrgNZHvlEz_DPpQXsvi-XDwFm7wC1pKXwKbQfG8M70RAH-iznlzATff7XMhYC9woWwOlA_YaIonJ8T9UAVGvpcM7Kwa0ck2-sznXeV9GSAjsvM6pGzONmxCQER5UDTCSv8zXmjmNB8U-_x4kRp4IZyaOkdlAFAXo6-60d_ZanduaqfmIYG_W4JF-JbLdUBl6uZRgBSy1KS9yyaYiP7hZb82foTuJbMed8txnOPErMNitSswMKduzduUzAU4XKGn7b4YnnSKfMHVIhNKCGj25vehaFPnvW8N_9mk1I2PdGxq5kRdVGzq9mYtahNR3D17rrvneDW5ECSp7haYhkVVOBnioBo4MmdTyGUdh0e76Y6oieu0v83dKUqXQULG6i8J107KHL0d7yKO2nRfY-ru-F7vknJlsfQtj2jMcZXxK3-Uq3xJrrcUKKsFted9o5iRlJh5af8JEqkal1bbpaKRQAlTYa3JvcNbsMmtDgQjYcK7mxYRU2tKzuf0P1UVh9pJiMH0t3VdaZj3tlPEGKI1BvfZLbB7LV_Y_pVPWgBbn4Ilj8oYuZnTNE0uYbqE13WNBSXI';
        $client = new Client ([
            'base_uri'=>'https://sgo-central-6to.herokuapp.com',
            //'timeout'=> 2.0,// tiempo a esperar por una respuesta
            'headers'=>['Authorization'=> $token]
        ]);
        $empleadosjson = $client->request('GET', "/api/empleados");
        $empleados =  json_decode($empleadosjson->getBody()->getContents(), true);
        $empleadosarr = $empleados['data:'];
          
        //dd($empleadosarr);

        return view('admin.empleado.index', compact('empleadosarr'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view ('admin.empleado.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $token= 'Bearer eyJ0eXAiOiJKV1QiLCJhbGciOiJSUzI1NiJ9.eyJhdWQiOiI1IiwianRpIjoiNTQyZWRlNWNhZjY1YjM4MGE3MDMyMjIxZjM1NmY4YTQxYjQwY2U3MGU3MDNmYTRiNzViYjk4ZmY0OWVjMDU0NTgwYThiY2I1ODQyMzEyYjkiLCJpYXQiOjE2MDMwNTk4ODYsIm5iZiI6MTYwMzA1OTg4NiwiZXhwIjoxNjM0NTk1ODg1LCJzdWIiOiI0Iiwic2NvcGVzIjpbXX0.VWEVXyX2sH6N9jmbdLeIpkgu1zOGWbS8E9UwEca34ic4j8HsgpN02O99p-cksj37b34Fa8Usf_LAjWRPPLPcQOutZVFKIjrIFgHrQsFDPrgNZHvlEz_DPpQXsvi-XDwFm7wC1pKXwKbQfG8M70RAH-iznlzATff7XMhYC9woWwOlA_YaIonJ8T9UAVGvpcM7Kwa0ck2-sznXeV9GSAjsvM6pGzONmxCQER5UDTCSv8zXmjmNB8U-_x4kRp4IZyaOkdlAFAXo6-60d_ZanduaqfmIYG_W4JF-JbLdUBl6uZRgBSy1KS9yyaYiP7hZb82foTuJbMed8txnOPErMNitSswMKduzduUzAU4XKGn7b4YnnSKfMHVIhNKCGj25vehaFPnvW8N_9mk1I2PdGxq5kRdVGzq9mYtahNR3D17rrvneDW5ECSp7haYhkVVOBnioBo4MmdTyGUdh0e76Y6oieu0v83dKUqXQULG6i8J107KHL0d7yKO2nRfY-ru-F7vknJlsfQtj2jMcZXxK3-Uq3xJrrcUKKsFted9o5iRlJh5af8JEqkal1bbpaKRQAlTYa3JvcNbsMmtDgQjYcK7mxYRU2tKzuf0P1UVh9pJiMH0t3VdaZj3tlPEGKI1BvfZLbB7LV_Y_pVPWgBbn4Ilj8oYuZnTNE0uYbqE13WNBSXI';
        $client = new Client ([
            'base_uri'=>'https://sgo-central-6to.herokuapp.com',
            //'timeout'=> 2.0,// tiempo a esperar por una respuesta
            'headers'=>['Authorization'=> $token]
        ]);

        $response = $client->request('POST', '/api/empleados', [
            'json' => [
                'emp_ci' => "$request->emp_ci",
                'emp_nom'=> "$request->emp_nom",
                'emp_dir'=> "$request->emp_dir",
                'emp_telf'=> "$request->emp_telf",
                'emp_crg'=> "$request->emp_crg",
                ]
            
        ]);

        $respdec =  json_decode($response->getBody()->getContents(), true);
        $empleado = $respdec['data'];


        //dd($empleado['id']);

        return redirect()->route('empleados.edit', $empleado['id'])->with('info', 'Empleado creado con éxito');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $token= 'Bearer eyJ0eXAiOiJKV1QiLCJhbGciOiJSUzI1NiJ9.eyJhdWQiOiI1IiwianRpIjoiNTQyZWRlNWNhZjY1YjM4MGE3MDMyMjIxZjM1NmY4YTQxYjQwY2U3MGU3MDNmYTRiNzViYjk4ZmY0OWVjMDU0NTgwYThiY2I1ODQyMzEyYjkiLCJpYXQiOjE2MDMwNTk4ODYsIm5iZiI6MTYwMzA1OTg4NiwiZXhwIjoxNjM0NTk1ODg1LCJzdWIiOiI0Iiwic2NvcGVzIjpbXX0.VWEVXyX2sH6N9jmbdLeIpkgu1zOGWbS8E9UwEca34ic4j8HsgpN02O99p-cksj37b34Fa8Usf_LAjWRPPLPcQOutZVFKIjrIFgHrQsFDPrgNZHvlEz_DPpQXsvi-XDwFm7wC1pKXwKbQfG8M70RAH-iznlzATff7XMhYC9woWwOlA_YaIonJ8T9UAVGvpcM7Kwa0ck2-sznXeV9GSAjsvM6pGzONmxCQER5UDTCSv8zXmjmNB8U-_x4kRp4IZyaOkdlAFAXo6-60d_ZanduaqfmIYG_W4JF-JbLdUBl6uZRgBSy1KS9yyaYiP7hZb82foTuJbMed8txnOPErMNitSswMKduzduUzAU4XKGn7b4YnnSKfMHVIhNKCGj25vehaFPnvW8N_9mk1I2PdGxq5kRdVGzq9mYtahNR3D17rrvneDW5ECSp7haYhkVVOBnioBo4MmdTyGUdh0e76Y6oieu0v83dKUqXQULG6i8J107KHL0d7yKO2nRfY-ru-F7vknJlsfQtj2jMcZXxK3-Uq3xJrrcUKKsFted9o5iRlJh5af8JEqkal1bbpaKRQAlTYa3JvcNbsMmtDgQjYcK7mxYRU2tKzuf0P1UVh9pJiMH0t3VdaZj3tlPEGKI1BvfZLbB7LV_Y_pVPWgBbn4Ilj8oYuZnTNE0uYbqE13WNBSXI';
        $client = new Client ([
            'base_uri'=>'https://sgo-central-6to.herokuapp.com',
            //'timeout'=> 2.0,// tiempo a esperar por una respuesta
            'headers'=>['Authorization'=> $token]
        ]);
        $empleadosjson = $client->request('GET', "/api/empleados/$id");

        $empleado =  json_decode($empleadosjson->getBody()->getContents(), true);
        $empleadoarr = $empleado['data'];
        
        //dd($empleadoarr);

        return view('admin.empleado.show', compact('empleadoarr'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $token= 'Bearer eyJ0eXAiOiJKV1QiLCJhbGciOiJSUzI1NiJ9.eyJhdWQiOiI1IiwianRpIjoiNTQyZWRlNWNhZjY1YjM4MGE3MDMyMjIxZjM1NmY4YTQxYjQwY2U3MGU3MDNmYTRiNzViYjk4ZmY0OWVjMDU0NTgwYThiY2I1ODQyMzEyYjkiLCJpYXQiOjE2MDMwNTk4ODYsIm5iZiI6MTYwMzA1OTg4NiwiZXhwIjoxNjM0NTk1ODg1LCJzdWIiOiI0Iiwic2NvcGVzIjpbXX0.VWEVXyX2sH6N9jmbdLeIpkgu1zOGWbS8E9UwEca34ic4j8HsgpN02O99p-cksj37b34Fa8Usf_LAjWRPPLPcQOutZVFKIjrIFgHrQsFDPrgNZHvlEz_DPpQXsvi-XDwFm7wC1pKXwKbQfG8M70RAH-iznlzATff7XMhYC9woWwOlA_YaIonJ8T9UAVGvpcM7Kwa0ck2-sznXeV9GSAjsvM6pGzONmxCQER5UDTCSv8zXmjmNB8U-_x4kRp4IZyaOkdlAFAXo6-60d_ZanduaqfmIYG_W4JF-JbLdUBl6uZRgBSy1KS9yyaYiP7hZb82foTuJbMed8txnOPErMNitSswMKduzduUzAU4XKGn7b4YnnSKfMHVIhNKCGj25vehaFPnvW8N_9mk1I2PdGxq5kRdVGzq9mYtahNR3D17rrvneDW5ECSp7haYhkVVOBnioBo4MmdTyGUdh0e76Y6oieu0v83dKUqXQULG6i8J107KHL0d7yKO2nRfY-ru-F7vknJlsfQtj2jMcZXxK3-Uq3xJrrcUKKsFted9o5iRlJh5af8JEqkal1bbpaKRQAlTYa3JvcNbsMmtDgQjYcK7mxYRU2tKzuf0P1UVh9pJiMH0t3VdaZj3tlPEGKI1BvfZLbB7LV_Y_pVPWgBbn4Ilj8oYuZnTNE0uYbqE13WNBSXI';
        $client = new Client ([
            'base_uri'=>'https://sgo-central-6to.herokuapp.com',
            //'timeout'=> 2.0,// tiempo a esperar por una respuesta
            'headers'=>['Authorization'=> $token]
        ]);
        $empleadojson = $client->request('GET', "/api/empleados/$id");

        $empleado =  json_decode($empleadojson->getBody()->getContents(), true);
        $empleadoarr = $empleado['data'];
        
        //dd($empleadoarr);

        return view('admin.empleado.edit', compact('empleadoarr'));  
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $token= 'Bearer eyJ0eXAiOiJKV1QiLCJhbGciOiJSUzI1NiJ9.eyJhdWQiOiI1IiwianRpIjoiNTQyZWRlNWNhZjY1YjM4MGE3MDMyMjIxZjM1NmY4YTQxYjQwY2U3MGU3MDNmYTRiNzViYjk4ZmY0OWVjMDU0NTgwYThiY2I1ODQyMzEyYjkiLCJpYXQiOjE2MDMwNTk4ODYsIm5iZiI6MTYwMzA1OTg4NiwiZXhwIjoxNjM0NTk1ODg1LCJzdWIiOiI0Iiwic2NvcGVzIjpbXX0.VWEVXyX2sH6N9jmbdLeIpkgu1zOGWbS8E9UwEca34ic4j8HsgpN02O99p-cksj37b34Fa8Usf_LAjWRPPLPcQOutZVFKIjrIFgHrQsFDPrgNZHvlEz_DPpQXsvi-XDwFm7wC1pKXwKbQfG8M70RAH-iznlzATff7XMhYC9woWwOlA_YaIonJ8T9UAVGvpcM7Kwa0ck2-sznXeV9GSAjsvM6pGzONmxCQER5UDTCSv8zXmjmNB8U-_x4kRp4IZyaOkdlAFAXo6-60d_ZanduaqfmIYG_W4JF-JbLdUBl6uZRgBSy1KS9yyaYiP7hZb82foTuJbMed8txnOPErMNitSswMKduzduUzAU4XKGn7b4YnnSKfMHVIhNKCGj25vehaFPnvW8N_9mk1I2PdGxq5kRdVGzq9mYtahNR3D17rrvneDW5ECSp7haYhkVVOBnioBo4MmdTyGUdh0e76Y6oieu0v83dKUqXQULG6i8J107KHL0d7yKO2nRfY-ru-F7vknJlsfQtj2jMcZXxK3-Uq3xJrrcUKKsFted9o5iRlJh5af8JEqkal1bbpaKRQAlTYa3JvcNbsMmtDgQjYcK7mxYRU2tKzuf0P1UVh9pJiMH0t3VdaZj3tlPEGKI1BvfZLbB7LV_Y_pVPWgBbn4Ilj8oYuZnTNE0uYbqE13WNBSXI';
        $client = new Client ([
            'base_uri'=>'https://sgo-central-6to.herokuapp.com',
            //'timeout'=> 2.0,// tiempo a esperar por una respuesta
            'headers'=>['Authorization'=> $token]
        ]);

        $response = $client->request('PUT', "/api/empleados/$id", [
            'json' => [
                'emp_ci' => "$request->emp_ci",
                'emp_nom'=> "$request->emp_nom",
                'emp_dir'=> "$request->emp_dir",
                'emp_telf'=> "$request->emp_telf",
                'emp_crg'=> "$request->emp_crg",
                ]
            
        ]);

        $respdec =  json_decode($response->getBody()->getContents(), true);
        $empleado = $respdec['data'];


        //dd($empleado['id']);

        return redirect()->route('empleados.edit', $empleado["id"])->with('info', 'Empleado actualizado con éxito');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $token= 'Bearer eyJ0eXAiOiJKV1QiLCJhbGciOiJSUzI1NiJ9.eyJhdWQiOiI1IiwianRpIjoiNTQyZWRlNWNhZjY1YjM4MGE3MDMyMjIxZjM1NmY4YTQxYjQwY2U3MGU3MDNmYTRiNzViYjk4ZmY0OWVjMDU0NTgwYThiY2I1ODQyMzEyYjkiLCJpYXQiOjE2MDMwNTk4ODYsIm5iZiI6MTYwMzA1OTg4NiwiZXhwIjoxNjM0NTk1ODg1LCJzdWIiOiI0Iiwic2NvcGVzIjpbXX0.VWEVXyX2sH6N9jmbdLeIpkgu1zOGWbS8E9UwEca34ic4j8HsgpN02O99p-cksj37b34Fa8Usf_LAjWRPPLPcQOutZVFKIjrIFgHrQsFDPrgNZHvlEz_DPpQXsvi-XDwFm7wC1pKXwKbQfG8M70RAH-iznlzATff7XMhYC9woWwOlA_YaIonJ8T9UAVGvpcM7Kwa0ck2-sznXeV9GSAjsvM6pGzONmxCQER5UDTCSv8zXmjmNB8U-_x4kRp4IZyaOkdlAFAXo6-60d_ZanduaqfmIYG_W4JF-JbLdUBl6uZRgBSy1KS9yyaYiP7hZb82foTuJbMed8txnOPErMNitSswMKduzduUzAU4XKGn7b4YnnSKfMHVIhNKCGj25vehaFPnvW8N_9mk1I2PdGxq5kRdVGzq9mYtahNR3D17rrvneDW5ECSp7haYhkVVOBnioBo4MmdTyGUdh0e76Y6oieu0v83dKUqXQULG6i8J107KHL0d7yKO2nRfY-ru-F7vknJlsfQtj2jMcZXxK3-Uq3xJrrcUKKsFted9o5iRlJh5af8JEqkal1bbpaKRQAlTYa3JvcNbsMmtDgQjYcK7mxYRU2tKzuf0P1UVh9pJiMH0t3VdaZj3tlPEGKI1BvfZLbB7LV_Y_pVPWgBbn4Ilj8oYuZnTNE0uYbqE13WNBSXI';
        $client = new Client ([
            'base_uri'=>'https://sgo-central-6to.herokuapp.com',
            //'timeout'=> 2.0,// tiempo a esperar por una respuesta
            'headers'=>['Authorization'=> $token]
        ]);
        $platojson = $client->request('DELETE', "/api/empleados/$id");

        return back()->with('info', 'Eliminado correctamente');
    }
}
