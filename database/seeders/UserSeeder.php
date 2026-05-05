<?php


namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use App\Models\Unit;
use App\Models\UserUnitRole;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    public function run(): void
    {
        $this->seedRootUnits();
        $this->seedAllOtherUnits();
    }

    private function seedRootUnits()
    {
        $roots = Unit::whereNull('parent_id')->get();

        foreach ($roots as $root) {
            $user = User::create([
                'first_name' => 'Head',
                'last_name' => $root->code,
                'email' => strtolower($root->code) . '@example.com',
                'password' => Hash::make('password'),
                'root_unit_id' => $root->id,
            ]);

            $user->assignRole('user');

            UserUnitRole::create([
                'user_id' => $user->id,
                'unit_id' => $root->id,
                'role' => UserUnitRole::ADMIN,
            ]);
        }
    }

    private function seedAllOtherUnits()
    {
        $units = Unit::whereNotNull('parent_id')->get();

        foreach ($units as $unit) {
            $rootId = $unit->ancestorsAndSelf->first(fn($u) => $u->parent_id === null)->id;

            // ADMIN
            $admin = User::create([
                'first_name' => 'Admin',
                'last_name' => $unit->code,
                'email' => strtolower($unit->code) . '_admin@example.com',
                'password' => Hash::make('password'),
                'root_unit_id' => $rootId,
            ]);

            $admin->assignRole('user');

            UserUnitRole::create([
                'user_id' => $admin->id,
                'unit_id' => $unit->id,
                'role' => UserUnitRole::ADMIN,
            ]);

            // STAFF 1
            $staff1 = User::create([
                'first_name' => 'Staff1',
                'last_name' => $unit->code,
                'email' => strtolower($unit->code) . '_staff1@example.com',
                'password' => Hash::make('password'),
                'root_unit_id' => $rootId,
            ]);

            $staff1->assignRole('user');

            UserUnitRole::create([
                'user_id' => $staff1->id,
                'unit_id' => $unit->id,
                'role' => UserUnitRole::STAFF,
            ]);

            // STAFF 2
            $staff2 = User::create([
                'first_name' => 'Staff2',
                'last_name' => $unit->code,
                'email' => strtolower($unit->code) . '_staff2@example.com',
                'password' => Hash::make('password'),
                'root_unit_id' => $rootId,
            ]);

            $staff2->assignRole('user');

            UserUnitRole::create([
                'user_id' => $staff2->id,
                'unit_id' => $unit->id,
                'role' => UserUnitRole::STAFF,
            ]);
        }
    }
}