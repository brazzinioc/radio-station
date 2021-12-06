<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role; //Model from Spatie package
use Spatie\Permission\Models\Permission;

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
        $role2 = Role::create(['name' => 'Admin']);
        $role3 = Role::create(['name' => 'Host']);
        $role4 = Role::create(['name' => 'Listener']);


        /**********************************
         * Permissions for Radio Stations.
         **********************************/
        Permission::create( [ 'name' => 'radiostations.index' ] )->syncRoles( [ $role2 ] );
        Permission::create( [ 'name' => 'radiostations.store' ] )->syncRoles( [ $role2 ] );
        Permission::create( [ 'name' => 'radiostations.show' ] )->syncRoles( [ $role2, $role3, $role4] );
        Permission::create( [ 'name' => 'radiostations.update' ] )->syncRoles( [ $role2 ] );
        Permission::create( [ 'name' => 'radiostations.destroy' ] )->syncRoles( [ $role2 ] );


    }
}
