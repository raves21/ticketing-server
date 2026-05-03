<?php

namespace Database\Seeders;

use App\Models\Unit;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class UnitSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $depth0 = [
            [
                'name' => 'City Information Technology Center',
                'code' => 'CITC',
            ],
            [
                'name' => 'City Mayor\'s Office',
                'code' => 'CMO',
            ],
            [
                'name' => 'Office of the City Building Official',
                'code' => 'OCBO',
            ]
        ];

        foreach ($depth0 as $unit) {
            Unit::create($unit);
        }

        $depth1 = [
            [
                'name' => 'Software Development and Management Division',
                'code' => 'CITC_SDMD',
                'parent_id' => 1
            ],
            [
                'name' => 'Network Division',
                'code' => 'CITC_ND',
                'parent_id' => 1
            ],
            [
                'name' => 'Administrative Division',
                'code' => 'CITC_AD',
                'parent_id' => 1
            ],
            // CMO depth1
            [
                'name' => 'Executive Division',
                'code' => 'CMO_ED',
                'parent_id' => 2
            ],
            [
                'name' => 'Public Relations Division',
                'code' => 'CMO_PRD',
                'parent_id' => 2
            ],
            [
                'name' => 'Legal Affairs Division',
                'code' => 'CMO_LAD',
                'parent_id' => 2
            ],
            // OCBO depth1
            [
                'name' => 'Building Permits Division',
                'code' => 'OCBO_BPD',
                'parent_id' => 3
            ],
            [
                'name' => 'Inspection and Compliance Division',
                'code' => 'OCBO_ICD',
                'parent_id' => 3
            ],
            [
                'name' => 'Administrative and Records Division',
                'code' => 'OCBO_ARD',
                'parent_id' => 3
            ],

        ];

        foreach ($depth1 as $unit) {
            Unit::create($unit);
        }

        $depth2 = [
            [
                'name' => 'Team Sharon',
                'code' => 'CITC_SDMD_TS',
                'parent_id' => 4
            ],
            [
                'name' => 'Team Art',
                'code' => 'CITC_SDMD_TA',
                'parent_id' => 4
            ],
            // CMO Executive Division depth2
            [
                'name' => 'Team Baste',
                'code' => 'CMO_ED_TB',
                'parent_id' => 7
            ],
            [
                'name' => 'Team Janelle',
                'code' => 'CMO_ED_TJ',
                'parent_id' => 7
            ],
            // OCBO Building Permits Division depth2
            [
                'name' => 'Team Bryan',
                'code' => 'OCBO_BPD_TB',
                'parent_id' => 10
            ],
            [
                'name' => 'Team Junald',
                'code' => 'OCBO_BPD_TJ',
                'parent_id' => 10
            ],
        ];

        foreach ($depth2 as $unit) {
            Unit::create($unit);
        }
    }
}
