<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class SetUpController extends Controller
{
    public function setUp(Request $request)
    {
        $permissions =  config("setup-config.permissions");
        // setup permissions
        foreach ($permissions as $permission) {
            Permission::create(['guard_name' => 'api', 'name' => $permission]);
        }
        // setup roles
        $roles = config("setup-config.roles");
        foreach ($roles as $role) {
            $role = Role::create(['guard_name' => 'api', 'name' => $role]);
        }
        // setup roles and permissions
        $role_permissions = config("setup-config.roles_permission");
        foreach ($role_permissions as $role_permission) {
            $role = Role::where(["name" => $role_permission["role"]])->first();
            $permissions = $role_permission["permissions"];
            foreach ($permissions as $permission) {
                $role->givePermissionTo($permission);
            }
        }

        return "You are done with setup";
    }
}
