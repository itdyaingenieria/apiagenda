<?php

namespace Database\Seeders;

use App\Models\Client;
use Carbon\Carbon;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ClientSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('clients')->delete();
        $data = [
            [
                'nombre' => 'Juan Diego Yama Mora',
                'cedula' => 1088251215,
                'fecha_nacimiento' => '1996-03-16',
                'user_id' => 1,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],
            [
                'nombre' => 'Arianna Abigail Yama Mora',
                'cedula' => 1088751277,
                'fecha_nacimiento' => '1999-04-18',
                'user_id' => 1,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ]
        ];
        Client::insert($data);

        // Testing Dummy clients
        Client::factory(50)->create();
    }
}
