<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Http\Requests\PlatoStoreRequest;
use App\Http\Requests\PlatoUpdateRequest;

use GuzzleHttp\Client;
use GuzzleHttp\Psr7;
use GuzzleHttp\Exception\ClientException;

class PlatoController extends Controller
{
    private $token, $client;

    public function __construct(){

        global $token, $client;
        $token = 'Bearer eyJ0eXAiOiJKV1QiLCJhbGciOiJSUzI1NiJ9.eyJhdWQiOiI1IiwianRpIjoiNTQyZWRlNWNhZjY1YjM4MGE3MDMyMjIxZjM1NmY4YTQxYjQwY2U3MGU3MDNmYTRiNzViYjk4ZmY0OWVjMDU0NTgwYThiY2I1ODQyMzEyYjkiLCJpYXQiOjE2MDMwNTk4ODYsIm5iZiI6MTYwMzA1OTg4NiwiZXhwIjoxNjM0NTk1ODg1LCJzdWIiOiI0Iiwic2NvcGVzIjpbXX0.VWEVXyX2sH6N9jmbdLeIpkgu1zOGWbS8E9UwEca34ic4j8HsgpN02O99p-cksj37b34Fa8Usf_LAjWRPPLPcQOutZVFKIjrIFgHrQsFDPrgNZHvlEz_DPpQXsvi-XDwFm7wC1pKXwKbQfG8M70RAH-iznlzATff7XMhYC9woWwOlA_YaIonJ8T9UAVGvpcM7Kwa0ck2-sznXeV9GSAjsvM6pGzONmxCQER5UDTCSv8zXmjmNB8U-_x4kRp4IZyaOkdlAFAXo6-60d_ZanduaqfmIYG_W4JF-JbLdUBl6uZRgBSy1KS9yyaYiP7hZb82foTuJbMed8txnOPErMNitSswMKduzduUzAU4XKGn7b4YnnSKfMHVIhNKCGj25vehaFPnvW8N_9mk1I2PdGxq5kRdVGzq9mYtahNR3D17rrvneDW5ECSp7haYhkVVOBnioBo4MmdTyGUdh0e76Y6oieu0v83dKUqXQULG6i8J107KHL0d7yKO2nRfY-ru-F7vknJlsfQtj2jMcZXxK3-Uq3xJrrcUKKsFted9o5iRlJh5af8JEqkal1bbpaKRQAlTYa3JvcNbsMmtDgQjYcK7mxYRU2tKzuf0P1UVh9pJiMH0t3VdaZj3tlPEGKI1BvfZLbB7LV_Y_pVPWgBbn4Ilj8oYuZnTNE0uYbqE13WNBSXI';
        $client = new Client ([
            'base_uri'=>'https://sgo-central-6to.herokuapp.com',
            //'timeout'=> 2.0,// tiempo a esperar por una respuesta
            'headers'=>['Authorization'=> $token]
        ]);

        $this->middleware('auth');
    }    
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('admin.plato.indextipo');

    }

    public function platosportipo($tipo)
    {
        global $client;

        $platosjson = $client->request('GET', "/api/tipoplatos/$tipo");
        $platos =  json_decode($platosjson->getBody()->getContents(), true);
        $platosarr = $platos['data'];

        //dd($platosarr);

        return view('admin.plato.index', compact('platosarr'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view ('admin.plato.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(PlatoStoreRequest $request)
    {
        global $client;

        $response = $client->request('POST', '/api/platos', [
            'json' => [
                'plt_nom' => "$request->plt_nom",
                'plt_des'=> "$request->plt_des",
                'plt_tipo'=> "$request->plt_tipo",
                'plt_pvp'=> "$request->plt_pvp",
                'plt_visbl'=> "$request->plt_visbl",
                'plt_iva'=>"$request->plt_iva",  
                ]            
        ]);

        $respdec =  json_decode($response->getBody()->getContents(), true);
        $plato = $respdec['data'];

        return redirect()->route('platos.edit', $plato['id'])->with('info', 'Plato creado con éxito');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        
        global $client;

        $platojson = $client->request('GET', "/api/platos/$id");

        $plato =  json_decode($platojson->getBody()->getContents(), true);
        $platoarr = $plato['data'];

        return view('admin.plato.show', compact('platoarr'));       
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        global $client;

        $platojson = $client->request('GET', "/api/platos/$id");

        $plato =  json_decode($platojson->getBody()->getContents(), true);
        $platoarr = $plato['data'];

        return view('admin.plato.edit', compact('platoarr'));  
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(PlatoUpdateRequest $request, $id)
    {
        global $client;

        $response = $client->request('PUT', "/api/platos/$id", [
            'json' => [
                'plt_nom' => "$request->plt_nom",
                'plt_des'=> "$request->plt_des",
                'plt_tipo'=> "$request->plt_tipo",
                'plt_pvp'=> "$request->plt_pvp",
                'plt_visbl'=> "$request->plt_visbl",
                'plt_iva'=>"$request->plt_iva",  
                ]
            
        ]);

        $respdec =  json_decode($response->getBody()->getContents(), true);
        $plato = $respdec['data'];

        return redirect()->route('platos.edit', $plato["id"])->with('info', 'Plato actualizado con éxito');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        global $client;

        $platojson = $client->request('DELETE', "/api/platos/$id");

        return back()->with('info', 'Eliminado correctamente');
    }
}
