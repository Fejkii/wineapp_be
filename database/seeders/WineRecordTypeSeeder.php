<?php

namespace Database\Seeders;

use App\Models\WineRecordType;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class WineRecordTypeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('wine_record_types')->insert(array(
            array(
                WineRecordType::TITLE => 'Měření síry',
            ),
            array(
                WineRecordType::TITLE => 'Zasíření',
            ),
            array(
                WineRecordType::TITLE => 'Měření bílkovin',
            ),
            array(
                WineRecordType::TITLE => 'Bentonit',
            ),
            array(
                WineRecordType::TITLE => 'Filtrování',
            ),
            array(
                WineRecordType::TITLE => 'Stahování',
            ),
            array(
                WineRecordType::TITLE => 'Ostatní',
            ),
        ));
    }
}
