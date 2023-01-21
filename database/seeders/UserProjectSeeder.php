<?php

namespace Database\Seeders;

use App\Models\UserProject;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class UserProjectSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('user_projects')->insert(array(
            array(
                UserProject::USER_ID => 1,
                UserProject::PROJECT_ID => 1,
                UserProject::IS_DEFAULT => true,
                UserProject::IS_OWNER => true,
                Model::CREATED_AT => now(),
            ),
            array(
                UserProject::USER_ID => 1,
                UserProject::PROJECT_ID => 2,
                UserProject::IS_DEFAULT => false,
                UserProject::IS_OWNER => true,
                Model::CREATED_AT => now(),
            ),
        ));
    }
}
