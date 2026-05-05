<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Unit;

class UnitSeeder extends Seeder
{
    public function run(): void
    {
        // ROOT UNITS
        $citc = Unit::create([
            'name' => 'City Information Technology Center',
            'code' => 'CITC',
        ]);

        $cmo = Unit::create([
            'name' => 'City Mayor\'s Office',
            'code' => 'CMO',
        ]);

        // ========================
        // CITC STRUCTURE
        // ========================

        $sysdev = Unit::create([
            'name' => 'SYSDEV Division',
            'code' => 'SYSDEV',
            'parent_id' => $citc->id,
        ]);

        $network = Unit::create([
            'name' => 'Network Division',
            'code' => 'NETWORK',
            'parent_id' => $citc->id,
        ]);

        $admin = Unit::create([
            'name' => 'Admin Division',
            'code' => 'ADMIN',
            'parent_id' => $citc->id,
        ]);

        // SYSDEV TEAMS

        $teamSharon = Unit::create([
            'name' => 'Team Sharon',
            'code' => 'TEAM_SHARON',
            'parent_id' => $sysdev->id,
        ]);

        Unit::create([
            'name' => 'Team Celina',
            'code' => 'TEAM_CELINA',
            'parent_id' => $teamSharon->id,
        ]);

        Unit::create([
            'name' => 'Team Melba',
            'code' => 'TEAM_MELBA',
            'parent_id' => $teamSharon->id,
        ]);

        $teamArturo = Unit::create([
            'name' => 'Team Arturo',
            'code' => 'TEAM_ARTURO',
            'parent_id' => $sysdev->id,
        ]);

        Unit::create([
            'name' => 'Team Reno',
            'code' => 'TEAM_RENO',
            'parent_id' => $teamArturo->id,
        ]);

        Unit::create([
            'name' => 'Team Louella',
            'code' => 'TEAM_LOUELLA',
            'parent_id' => $teamArturo->id,
        ]);

        Unit::create([
            'name' => 'Team Jun',
            'code' => 'TEAM_JUN',
            'parent_id' => $sysdev->id,
        ]);

        // ========================
        // CMO STRUCTURE (simpler)
        // ========================

        $exec = Unit::create([
            'name' => 'Executive Division',
            'code' => 'EXEC',
            'parent_id' => $cmo->id,
        ]);

        $legal = Unit::create([
            'name' => 'Legal Division',
            'code' => 'LEGAL',
            'parent_id' => $cmo->id,
        ]);

        Unit::create([
            'name' => 'Public Affairs Team',
            'code' => 'PA_TEAM',
            'parent_id' => $exec->id,
        ]);

        Unit::create([
            'name' => 'Compliance Team',
            'code' => 'COMP_TEAM',
            'parent_id' => $legal->id,
        ]);
    }
}