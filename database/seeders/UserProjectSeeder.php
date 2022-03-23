<?php

namespace Database\Seeders;

use App\Models\UserProject;
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
            ),
            array(
                UserProject::USER_ID => 1,
                UserProject::PROJECT_ID => 2,
            ),
        ));
    }
}
