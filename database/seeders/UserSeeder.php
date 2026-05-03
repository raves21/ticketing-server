<?php

namespace Database\Seeders;

use App\Models\Unit;
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
        $citcUsers = [
            [
                'first_name' => 'Nep',
                'last_name' => 'Talavera',
                'unit_id' => Unit::where('code', 'CITC')->first()->id,
                'email' => 'nep@ticketing.com',
                'password' => 'ticketing'
            ],
            [
                'first_name' => 'Sharon',
                'last_name' => 'Lomantas',
                'unit_id' => Unit::where('code', 'SDMD_SHARON')->first()->id,
                'email' => 'sharon@ticketing.com',
                'password' => 'ticketing'
            ],
            [
                'first_name' => 'Doodz',
                'last_name' => 'Lopez',
                'unit_id' => Unit::where('code', 'CITC_ND')->first()->id,
                'email' => 'doodz@ticketing.com',
                'password' => 'ticketing'
            ],
            [
                'first_name' => 'Myla',
                'last_name' => 'Myla',
                'unit_id' => Unit::where('code', 'CITC_AD')->first()->id,
                'email' => 'myla@ticketing.com',
                'password' => 'ticketing'
            ],
            [
                'first_name' => 'Arib',
                'last_name' => 'Ranara',
                'unit_id' => Unit::where('code', 'SDMD_SHARON')->first()->id,
                'email' => 'arib@ticketing.com',
                'password' => 'ticketing'
            ],
            [
                'first_name' => 'Rexdan',
                'last_name' => 'Tautho',
                'unit_id' => Unit::where('code', 'CITC_ND')->first()->id,
                'email' => 'rexdan@ticketing.com',
                'password' => 'ticketing'
            ],
            [
                'first_name' => 'Mafe',
                'last_name' => 'Caledes',
                'unit_id' => Unit::where('code', 'CITC_AD')->first()->id,
                'email' => 'mafe@ticketing.com',
                'password' => 'ticketing'
            ],
        ];

        foreach ($citcUsers as $user) {
            $user = User::create($user);
            $user->assignRole('user');
        }

        $cmoUsers = [
            [
                'first_name' => 'Baste',
                'last_name' => 'Osmena',
                'unit_id' => Unit::where('code', 'CMO')->first()->id,
                'email' => 'baste@ticketing.com',
                'password' => 'ticketing'
            ],
            [
                'first_name' => 'Janelle',
                'last_name' => 'Santos',
                'unit_id' => Unit::where('code', 'CMO_ED')->first()->id,
                'email' => 'janelle@ticketing.com',
                'password' => 'ticketing'
            ],
            [
                'first_name' => 'Carlo',
                'last_name' => 'Reyes',
                'unit_id' => Unit::where('code', 'CMO_PRD')->first()->id,
                'email' => 'carlo@ticketing.com',
                'password' => 'ticketing'
            ],
            [
                'first_name' => 'Liza',
                'last_name' => 'Montoya',
                'unit_id' => Unit::where('code', 'CMO_LAD')->first()->id,
                'email' => 'liza@ticketing.com',
                'password' => 'ticketing'
            ],
            [
                'first_name' => 'Marco',
                'last_name' => 'Villanueva',
                'unit_id' => Unit::where('code', 'CMO_ED_TB')->first()->id,
                'email' => 'marco@ticketing.com',
                'password' => 'ticketing'
            ],
            [
                'first_name' => 'Nina',
                'last_name' => 'Flores',
                'unit_id' => Unit::where('code', 'CMO_ED_TJ')->first()->id,
                'email' => 'nina@ticketing.com',
                'password' => 'ticketing'
            ],
        ];

        foreach ($cmoUsers as $user) {
            $user = User::create($user);
            $user->assignRole('user');
        }

        $ocboUsers = [
            [
                'first_name' => 'Bryan',
                'last_name' => 'Dela Cruz',
                'unit_id' => Unit::where('code', 'OCBO')->first()->id,
                'email' => 'bryan@ticketing.com',
                'password' => 'ticketing'
            ],
            [
                'first_name' => 'Junald',
                'last_name' => 'Macaraeg',
                'unit_id' => Unit::where('code', 'OCBO_BPD')->first()->id,
                'email' => 'junald@ticketing.com',
                'password' => 'ticketing'
            ],
            [
                'first_name' => 'Rosa',
                'last_name' => 'Aguirre',
                'unit_id' => Unit::where('code', 'OCBO_ICD')->first()->id,
                'email' => 'rosa@ticketing.com',
                'password' => 'ticketing'
            ],
            [
                'first_name' => 'Tony',
                'last_name' => 'Bautista',
                'unit_id' => Unit::where('code', 'OCBO_ARD')->first()->id,
                'email' => 'tony@ticketing.com',
                'password' => 'ticketing'
            ],
            [
                'first_name' => 'Gem',
                'last_name' => 'Soriano',
                'unit_id' => Unit::where('code', 'OCBO_BPD_TB')->first()->id,
                'email' => 'gem@ticketing.com',
                'password' => 'ticketing'
            ],
            [
                'first_name' => 'Rhea',
                'last_name' => 'Navarro',
                'unit_id' => Unit::where('code', 'OCBO_BPD_TJ')->first()->id,
                'email' => 'rhea@ticketing.com',
                'password' => 'ticketing'
            ],
        ];

        foreach ($ocboUsers as $user) {
            $user = User::create($user);
            $user->assignRole('user');
        }
    }
}
