<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        if (config('app.env') === 'local') {
            // Super Admin User
            User::create([
                "name" => "Jhon",
                "last_name" => "Doe Doe",
                "about" => "I'm super admin",
                "email" => "jhon.doe@rs.com",
                "password" => bcrypt("myP@ssword159")
            ])->assignRole('Super Admin');

            // Admin User
            User::create([
                "name" => "Fiorella",
                "last_name" => "Flowers Díaz",
                "about" => "I'm admin",
                "email" => "fiorella.flowers@rs.com",
                "password" => bcrypt("myP@ssword159")
            ])->assignRole('Admin');

            // Host User
            User::create([
                "name" => "Anthony",
                "last_name" => "Rodriguez Lima",
                "about" => "I'm host",
                "email" => "anthony.rodriguez@rs.com",
                "password" => bcrypt("myP@ssword159")
            ])->assignRole('Host');

            // Listener
            User::create([
                "name" => "Sonia",
                "last_name" => "Orellana Pilar",
                "about" => "I'm listener",
                "email" => "sonia.orellana@rs.com",
                "password" => bcrypt("myP@ssword159")
            ])->assignRole('Listener');

        }
    }
}
