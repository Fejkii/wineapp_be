<?php

namespace Database\Seeders;

use App\Models\ProjectSettings;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ProjectSettingsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('project_settings')->insert(array(
            array(
                ProjectSettings::PROJECT_ID => 1,
            ),
            array(
                ProjectSettings::PROJECT_ID => 2,
            ),
        ));
    }
}
