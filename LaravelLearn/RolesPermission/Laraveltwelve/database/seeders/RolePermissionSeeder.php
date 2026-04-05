<?php
namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
class RolePermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */


public function run()
{
    Permission::create(['name' => 'post.create']);
    Permission::create(['name' => 'post.update']);
    Permission::create(['name' => 'post.delete']);

    $admin = Role::create(['name' => 'admin']);
    $admin->givePermissionTo(Permission::all());
}
}
