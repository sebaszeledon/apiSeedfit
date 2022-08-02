<?php

namespace App\Http\Controllers;

use App\Models\Provider;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class ProviderController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        try {
            /*  Listado de proveedores
            */
            $providers = Provider::orderBy('id', 'asc')->get();
            $response = $providers;

            return response()->json($response, 200);
        } catch (\Exception $e) {
            return response()->json($e->getMessage(), 422);
        }
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validator = Validator::make(
            $request->all(),
            [
                'description' => 'required|min:3',
                'website' => 'required|min:3',
                'country' => 'required|min:3',
                'address' => 'required|min:3',
            ]
        );

        if ($validator->fails()) {
            return response()->json($validator->messages(), 422);
        }

        try {
            //Instancia
            $provider = new Provider();
            $provider->description = $request->input('description');
            $provider->website = $request->input('website');
            $provider->country = $request->input('country');
            $provider->address = $request->input('address');
            $provider->save();

            $respuesta = 'Proveedor creado!';
            return response()->json($respuesta, 201);
        } catch (\Exception $e) {
            return response()->json($e->getMessage(), 422);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Provider  $provider
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        try {
            //Obtener un producto
            $provider = Provider::where('id', $id)->with(['agents', 'products'])->first();
            $response = $provider;
            return response()->json($response, 200);
        } catch (\Exception $e) {
            return response()->json($e->getMessage(), 422);
        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Provider  $provider
     * @return \Illuminate\Http\Response
     */
    public function edit(Provider $provider)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Provider  $provider
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $validator = Validator::make(
            $request->all(),
            [
                'description' => 'required|min:3',
                'website' => 'required|min:3',
                'country' => 'required|min:3',
                'address' => 'required|min:3',
            ]
        );

        if ($validator->fails()) {
            return response()->json($validator->messages(), 422);
        }

        $provider = Provider::find($id);
        $provider->description = $request->input('description');
        $provider->website = $request->input('website');
        $provider->country = $request->input('country');
        $provider->address = $request->input('address');
        $provider->update();

        $response = 'Proveedor actualizado!';
        return response()->json($response, 200);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Provider  $provider
     * @return \Illuminate\Http\Response
     */
    public function destroy(Provider $provider)
    {
        //
    }
}
