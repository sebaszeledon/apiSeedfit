<?php

namespace App\Http\Controllers;

use App\Models\Transaction;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;


class TransactionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        try {
            //$transaction = Transaction::all();
            $transaction = Transaction::orderBy('date', 'desc')->with(['user', 'type', 'products'])->get();
            $response = $transaction;
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
        DB::beginTransaction();
        try {
            //Instancia orden
            $orden = new Transaction();
            //Fecha actual o dada por el usuario depende de la aplicación
            $orden->date = Carbon::parse(Carbon::now())->format('Y-m-d');;
            $user = auth('api')->user();
            $orden->user()->associate($user->id);
            $orden->type_id = $request->input('type_id');
            $orden->total_quantity = $request->input('qtyItems');
            $orden->total_amount = $request->input('total');
            $orden->description = $request->input('desc');
            $orden->observation = $request->input('obs');

            //Guardar encabezado
            $orden->save();
            //Instancias Detalle orden
            //La siguiente variable debe contener todos los elementos necesarios para registrar el detalle de la orden
            $detalles = $request->input('detalles');
            foreach ($detalles as $item) {
                $orden->products()->attach($item['idItem'], [
                    'quantity' => $item['cantidad'],
                    'subtotal' => $item['subtotal'],
                ]);
            }
            DB::commit();
            $response = 'Orden creada!';
            return response()->json($response, 201);
        } catch (\Exception $e) {
            DB::rollback();
            return response()->json($e->getMessage(), 422);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Transaction  $transaction
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        try {
            //Obtener un producto
            $transaction = Transaction::where('id', $id)->with(['user', 'type', 'products'])->first();
            $response = $transaction;
            return response()->json($response, 200);
        } catch (\Exception $e) {
            return response()->json($e->getMessage(), 422);
        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Transaction  $transaction
     * @return \Illuminate\Http\Response
     */
    public function edit(Transaction $transaction)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Transaction  $transaction
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Transaction $transaction)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Transaction  $transaction
     * @return \Illuminate\Http\Response
     */
    public function destroy(Transaction $transaction)
    {
        //
    }
}
