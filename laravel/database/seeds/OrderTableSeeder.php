<?php

use Illuminate\Database\Seeder;

class OrderTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        /*$order = new Order();
        $order->state = 0;
        $order->user_id = 1;
        $order->delivery_type = 0;
        $order->payment_type = 0;
        $order->save();*/

        DB::table('storeorder')->insert([
            'state' => 0,
            'user_id' => 3,
            'delivery_type' => 0,
            'payment_type' => 0,
        ]);

    }
}
