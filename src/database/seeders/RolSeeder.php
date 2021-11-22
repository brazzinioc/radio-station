<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;

class RolSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $role1 = Role::create(['name' => 'Super Admin']);
        $role1 = Role::create(['name' => 'Admin']);
        $role2 = Role::create(['name' => 'Host']);
    }
}
