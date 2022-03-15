<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('users')->insert(array(
            array(
                User::EMAIL => 'petr@test.cz',
                User::PASSWORD => bcrypt('password'),
                User::EMAIL_VERIFIED_AT => now(),
                User::CREATED_AT => now(),
            ),
            array(
                User::EMAIL => 'tom@test.cz',
                User::PASSWORD => bcrypt('password'),
                User::EMAIL_VERIFIED_AT => now(),
                User::CREATED_AT => now(),
            ),
            array(
                User::EMAIL => 'test@test.cz',
                User::PASSWORD => bcrypt('password'),
                User::EMAIL_VERIFIED_AT => now(),
                User::CREATED_AT => now(),
            ),
            array(
                User::EMAIL => 'holka@test.cz',
                User::PASSWORD => bcrypt('password'),
                User::EMAIL_VERIFIED_AT => now(),
                User::CREATED_AT => now(),
            ),
            array(
                User::EMAIL => 'admin@test.cz',
                User::PASSWORD => bcrypt('password'),
                User::EMAIL_VERIFIED_AT => now(),
                User::CREATED_AT => now(),
            ),
        ));
    }
}
