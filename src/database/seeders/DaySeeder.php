<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class DaySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('days')->insert(['name' => 'lunes', 'created_at' => now(), 'updated_at' => now() ]);
        DB::table('days')->insert(['name' => 'martes',  'created_at' => now(), 'updated_at' => now() ]);
        DB::table('days')->insert(['name' => 'miércoles',  'created_at' => now(), 'updated_at' => now() ]);
        DB::table('days')->insert(['name' => 'jueves',  'created_at' => now(), 'updated_at' => now() ]);
        DB::table('days')->insert(['name' => 'viernes',  'created_at' => now(), 'updated_at' => now() ]);
        DB::table('days')->insert(['name' => 'sábado',  'created_at' => now(), 'updated_at' => now() ]);
        DB::table('days')->insert(['name' => 'domingo',  'created_at' => now(), 'updated_at' => now() ]);
    }
}
