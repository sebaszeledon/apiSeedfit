<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class TransactionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //Instancia de transaction 1
        $transaction = new \App\Models\Transaction();
        $transaction->user_id = 2;
        $transaction->type_id = 1;
        $transaction->date = '2021-7-6';
        $transaction->total_quantity = 10;
        $transaction->total_amount = 50000.00;
        $transaction->description = 'Ingreso';
        $transaction->observation = 'Surtido de inventario';
        $transaction->save();

        //Agregar contenido en tabla pivot product_transaction
        $transaction->products()->attach([
            1 => ['quantity' => 2, 'subtotal' => 16000],
            2 => ['quantity' => 1, 'subtotal' => 7500]
        ]);

        $transaction = new \App\Models\Transaction();
        $transaction->user_id = 1;
        $transaction->type_id = 2;
        $transaction->date = '2021-7-6';
        $transaction->total_quantity = 1;
        $transaction->total_amount = 8000.00;
        $transaction->description = 'Venta';
        $transaction->observation = 'Venta por instagram';
        $transaction->save();

        //Agregar contenido en tabla pivot product_transaction
        $transaction->products()->attach([
            1 => ['quantity' => 1, 'subtotal' => 8000]
        ]);
    }
}
