<?php

namespace Database\Seeders;

use App\Models\Project;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ProjectSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('projects')->insert(array(
            array(
                Project::TITLE => 'Happy wine',
            ),
            array(
                Project::TITLE => 'Second project',
            ),
        ));
    }
}
