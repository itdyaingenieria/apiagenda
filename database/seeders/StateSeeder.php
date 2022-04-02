<?php

namespace Database\Seeders;

use App\Models\State;
use Carbon\Carbon;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class StateSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('states')->delete();
        $data = [
            [
                'estado' => 'Programada',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],
            [
                'estado' => 'Realizada',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],
            [
                'estado' => 'Cancelada',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],
            [
                'estado' => 'No Asistida',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ]
        ];
        State::insert($data);
    }
}
