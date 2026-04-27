<?php

namespace Database\Seeders;

use App\Models\Office;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $users = [
            [
                'first_name' => 'Super',
                'last_name' => 'Admin',
                'office_id' => Office::where('code', 'CITC')->first()->id,
                'email' => 'super@ticketing.com',
                'password' => 'ticketing'
            ],
            [
                'first_name' => fake()->firstName(),
                'last_name' => fake()->lastName(),
                'office_id' => Office::where('code', 'CITC')->first()->id,
                'email' => 'citc1@ticketing.com',
                'password' => 'ticketing'
            ],
            [
                'first_name' => fake()->firstName(),
                'last_name' => fake()->lastName(),
                'office_id' => Office::where('code', 'CITC')->first()->id,
                'email' => 'citc2@ticketing.com',
                'password' => 'ticketing'
            ],
            [
                'first_name' => fake()->firstName(),
                'last_name' => fake()->lastName(),
                'office_id' => Office::where('code', 'CMO')->first()->id,
                'email' => 'cmo1@ticketing.com',
                'password' => 'ticketing'
            ],
            [
                'first_name' => fake()->firstName(),
                'last_name' => fake()->lastName(),
                'office_id' => Office::where('code', 'GSO')->first()->id,
                'email' => 'gso1@ticketing.com',
                'password' => 'ticketing'
            ],
            [
                'first_name' => fake()->firstName(),
                'last_name' => fake()->lastName(),
                'office_id' => Office::where('code', 'CPDO')->first()->id,
                'email' => 'cpdo1@ticketing.com',
                'password' => 'ticketing'
            ],
            [
                'first_name' => fake()->firstName(),
                'last_name' => fake()->lastName(),
                'office_id' => Office::where('code', 'CBO')->first()->id,
                'email' => 'cbo1@ticketing.com',
                'password' => 'ticketing'
            ],
            [
                'first_name' => fake()->firstName(),
                'last_name' => fake()->lastName(),
                'office_id' => Office::where('code', 'CAO')->first()->id,
                'email' => 'cao1@ticketing.com',
                'password' => 'ticketing'
            ],
            [
                'first_name' => fake()->firstName(),
                'last_name' => fake()->lastName(),
                'office_id' => Office::where('code', 'CTO')->first()->id,
                'email' => 'cto1@ticketing.com',
                'password' => 'ticketing'
            ],
            [
                'first_name' => fake()->firstName(),
                'last_name' => fake()->lastName(),
                'office_id' => Office::where('code', 'CHO')->first()->id,
                'email' => 'cho1@ticketing.com',
                'password' => 'ticketing'
            ],
            [
                'first_name' => fake()->firstName(),
                'last_name' => fake()->lastName(),
                'office_id' => Office::where('code', 'CSWDO')->first()->id,
                'email' => 'cswdo1@ticketing.com',
                'password' => 'ticketing'
            ],
            [
                'first_name' => fake()->firstName(),
                'last_name' => fake()->lastName(),
                'office_id' => Office::where('code', 'CENRO')->first()->id,
                'email' => 'cenro10@ticketing.com',
                'password' => 'ticketing'
            ],
            [
                'first_name' => fake()->firstName(),
                'last_name' => fake()->lastName(),
                'office_id' => Office::where('code', 'CEO')->first()->id,
                'email' => 'ceo1@ticketing.com',
                'password' => 'ticketing'
            ]
        ];

        foreach ($users as $user) {
            $user = User::create($user);
            if ($user['first_name'] === 'Super') {
                $user->assignRole('superadmin');
            } else {
                $user->assignRole('user');
            }
        }
    }
}
