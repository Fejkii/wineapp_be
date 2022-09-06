<?php

namespace Database\Seeders;

use App\Models\Project;
use Illuminate\Database\Eloquent\Model;
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
                Model::CREATED_AT => now(),
            ),
            array(
                Project::TITLE => 'Second project',
                Model::CREATED_AT => now(),
            ),
        ));
    }
}
