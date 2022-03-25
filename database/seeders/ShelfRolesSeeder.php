<?php

namespace Database\Seeders;

use App\Enums\RolesEnum;
use App\Models\User;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Spatie\Permission\PermissionRegistrar;

class ShelfRolesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Reset cached roles and permissions
        app()[PermissionRegistrar::class]->forgetCachedPermissions();

        $roleSuperAdmin = Role::query()->create([
                'name'       => RolesEnum::SUPER_ADMIN,
                'guard_name' => 'api',
        ]);

        $superAdmin = User::query()->where('full_name', 'super-admin')->first();
        $superAdmin->assignRole($roleSuperAdmin);

        $roleManager = Role::query()->create([
            'name'       => RolesEnum::MANAGER,
            'guard_name' => 'api',
        ]);

        $manager = User::query()->where('full_name', 'manager')->first();
        $manager->assignRole($roleManager);
    }
}
