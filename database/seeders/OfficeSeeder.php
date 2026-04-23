<?php

namespace Database\Seeders;

use App\Models\Office;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class OfficeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $offices = [
            [
                'name' => 'City Mayor\'s Office',
                'code' => 'CMO',
            ],
            [
                'name' => 'City Information Technology Center',
                'code' => 'CITC',
            ],
            [
                'name' => 'General Service Office',
                'code' => 'GSO',
            ],
            [
                'name' => 'City Planning and Development Office',
                'code' => 'CPDO',
            ],
            [
                'name' => 'City Budget Office',
                'code' => 'CBO',
            ],
            [
                'name' => 'City Accountant\'s Office',
                'code' => 'CAO',
            ],
            [
                'name' => 'City Treasurer\'s Office',
                'code' => 'CTO',
            ],
            [
                'name' => 'City Health Office',
                'code' => 'CHO',
            ],
            [
                'name' => 'City Social Welfare and Development Office',
                'code' => 'CSWDO',
            ],
            [
                'name' => 'City Environment and Natural Resources Office',
                'code' => 'CENRO',
            ],
            [
                'name' => 'City Engineer\'s Office',
                'code' => 'CEO',
            ],
        ];

        foreach ($offices as $office) {
            Office::create($office);
        }
    }
}
