<?php

use App\Models\ProjectSettings;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProjectSettingsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('project_settings', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger(ProjectSettings::PROJECT_ID);
            $table->double(ProjectSettings::DEFAULT_FREE_SULFUR)->default(40);
            $table->double(ProjectSettings::DEFAULT_LIQUID_SULFUR)->default(15);

            $table->foreign(ProjectSettings::PROJECT_ID)->references('id')->on('projects');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('project_settings');
    }
}
