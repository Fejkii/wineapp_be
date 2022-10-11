<?php

namespace Database\Seeders;

use App\Models\Wine;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class WineSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('wines')->insert(array(
            array(
                Wine::PROJECT_ID => 1,
                Wine::WINE_VARIETY_ID => 1,
                Wine::TITLE => "Tramín 2022",
                Model::CREATED_AT => now(),
            ),
            array(
                Wine::PROJECT_ID => 1,
                Wine::WINE_VARIETY_ID => 2,
                Wine::TITLE => "Mullerka 2021",
                Model::CREATED_AT => now(),
            ),
            array(
                Wine::PROJECT_ID => 1,
                Wine::WINE_VARIETY_ID => 3,
                Wine::TITLE => "Frankovka 2020",
                Model::CREATED_AT => now(),
            ),
        ));
    }
}
