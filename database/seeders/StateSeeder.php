<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Carbon\Carbon;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;
use App\Models\Modual;

class StateSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $permissions = [
            'states.view','states.create','states.update','states.destroy',
        ];
        
        foreach($permissions as $permission){
            Permission::create([
                'name'=>$permission
            ]);
        }
        app()[\Spatie\Permission\PermissionRegistrar::class]->forgetCachedPermissions();
        $role = Role::where('name', '=','admin')->first();
        $role->givePermissionTo($permissions);
    }
}
