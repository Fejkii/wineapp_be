<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Eloquent\Model;
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
                User::NAME => 'petr',
                User::EMAIL => 'petr@test.cz',
                User::PASSWORD => bcrypt('password'),
                User::EMAIL_VERIFIED_AT => now(),
                Model::CREATED_AT => now(),
            ),
            array(
                User::NAME => 'Tom',
                User::EMAIL => 'tom@test.cz',
                User::PASSWORD => bcrypt('password'),
                User::EMAIL_VERIFIED_AT => now(),
                Model::CREATED_AT => now(),
            ),
            array(
                User::NAME => 'test',
                User::EMAIL => 'test@test.cz',
                User::PASSWORD => bcrypt('password'),
                User::EMAIL_VERIFIED_AT => now(),
                Model::CREATED_AT => now(),
            ),
            array(
                User::NAME => 'girl',
                User::EMAIL => 'holka@test.cz',
                User::PASSWORD => bcrypt('password'),
                User::EMAIL_VERIFIED_AT => now(),
                Model::CREATED_AT => now(),
            ),
            array(
                User::NAME => 'Admin',
                User::EMAIL => 'admin@test.cz',
                User::PASSWORD => bcrypt('password'),
                User::EMAIL_VERIFIED_AT => now(),
                Model::CREATED_AT => now(),
            ),
        ));
    }
}
