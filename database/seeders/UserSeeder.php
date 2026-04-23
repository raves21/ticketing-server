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
                'office_id' => Office::where('code', 'CMO')->first()->id,
                'email' => 'user1@ticketing.com',
                'password' => 'ticketing'
            ],
            [
                'first_name' => fake()->firstName(),
                'last_name' => fake()->lastName(),
                'office_id' => Office::where('code', 'CITC')->first()->id,
                'email' => 'user2@ticketing.com',
                'password' => 'ticketing'
            ],
            [
                'first_name' => fake()->firstName(),
                'last_name' => fake()->lastName(),
                'office_id' => Office::where('code', 'GSO')->first()->id,
                'email' => 'user3@ticketing.com',
                'password' => 'ticketing'
            ],
            [
                'first_name' => fake()->firstName(),
                'last_name' => fake()->lastName(),
                'office_id' => Office::where('code', 'CPDO')->first()->id,
                'email' => 'user4@ticketing.com',
                'password' => 'ticketing'
            ],
            [
                'first_name' => fake()->firstName(),
                'last_name' => fake()->lastName(),
                'office_id' => Office::where('code', 'CBO')->first()->id,
                'email' => 'user5@ticketing.com',
                'password' => 'ticketing'
            ],
            [
                'first_name' => fake()->firstName(),
                'last_name' => fake()->lastName(),
                'office_id' => Office::where('code', 'CAO')->first()->id,
                'email' => 'user6@ticketing.com',
                'password' => 'ticketing'
            ],
            [
                'first_name' => fake()->firstName(),
                'last_name' => fake()->lastName(),
                'office_id' => Office::where('code', 'CTO')->first()->id,
                'email' => 'user7@ticketing.com',
                'password' => 'ticketing'
            ],
            [
                'first_name' => fake()->firstName(),
                'last_name' => fake()->lastName(),
                'office_id' => Office::where('code', 'CHO')->first()->id,
                'email' => 'user8@ticketing.com',
                'password' => 'ticketing'
            ],
            [
                'first_name' => fake()->firstName(),
                'last_name' => fake()->lastName(),
                'office_id' => Office::where('code', 'CSWDO')->first()->id,
                'email' => 'user9@ticketing.com',
                'password' => 'ticketing'
            ],
            [
                'first_name' => fake()->firstName(),
                'last_name' => fake()->lastName(),
                'office_id' => Office::where('code', 'CENRO')->first()->id,
                'email' => 'user10@ticketing.com',
                'password' => 'ticketing'
            ],
            [
                'first_name' => fake()->firstName(),
                'last_name' => fake()->lastName(),
                'office_id' => Office::where('code', 'CEO')->first()->id,
                'email' => 'user11@ticketing.com',
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
