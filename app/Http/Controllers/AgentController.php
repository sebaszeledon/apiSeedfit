<?php

namespace App\Http\Controllers;

use App\Models\Agent;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class AgentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        try {
            /*  Listado de agentes
            */
            $agents = Agent::orderBy('id', 'asc')->get();
            $response = $agents;

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
                'name' => 'required|min:3',
                'lastname' => 'required|min:3',
                'phone' => 'required|min:3',
                'email' => 'required|min:3',
                'provider_id' => 'required',
            ]
        );

        if ($validator->fails()) {
            return response()->json($validator->messages(), 422);
        }

        try {
            //Instancia
            $agent = new Agent();
            $agent->name = $request->input('name');
            $agent->lastname = $request->input('lastname');
            $agent->phone = $request->input('phone');
            $agent->email = $request->input('email');
            $agent->provider_id = $request->input('provider_id');
            $agent->save();

            $respuesta = 'Agente creado!';
            return response()->json($respuesta, 201);
        } catch (\Exception $e) {
            return response()->json($e->getMessage(), 422);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Agent  $agent
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        try {
            /*  Listado de agentes
            */
            $agents = Agent::where('id', $id)->first();
            $response = $agents;

            return response()->json($response, 200);
        } catch (\Exception $e) {
            return response()->json($e->getMessage(), 422);
        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Agent  $agent
     * @return \Illuminate\Http\Response
     */
    public function edit(Agent $agent)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Agent  $agent
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $validator = Validator::make(
            $request->all(),
            [
                'name' => 'required|min:3',
                'lastname' => 'required|min:3',
                'phone' => 'required|min:3',
                'email' => 'required|min:3',
                'provider_id' => 'required',
            ]
        );

        if ($validator->fails()) {
            return response()->json($validator->messages(), 422);
        }

        $agent = Agent::find($id);
        $agent->name = $request->input('name');
        $agent->lastname = $request->input('lastname');
        $agent->phone = $request->input('phone');
        $agent->email = $request->input('email');
        $agent->provider_id = $request->input('provider_id');
        $agent->update();

        $response = 'Agente actualizado!';
        return response()->json($response, 200);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Agent  $agent
     * @return \Illuminate\Http\Response
     */
    public function destroy(Agent $agent)
    {
        //
    }
}
