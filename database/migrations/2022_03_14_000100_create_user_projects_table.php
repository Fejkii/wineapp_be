<?php

use App\Models\UserProject;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUserProjectsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('user_projects', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger(UserProject::USER_ID);
            $table->unsignedBigInteger(UserProject::PROJECT_ID);
            $table->timestamps();

            $table->foreign(UserProject::USER_ID)->references('id')->on('users');
            $table->foreign(UserProject::PROJECT_ID)->references('id')->on('projects');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('user_projects');
    }
}
