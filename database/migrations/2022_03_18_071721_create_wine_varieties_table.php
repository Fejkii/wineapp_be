<?php

use App\Models\WineVariety;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateWineVarietiesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('wine_varieties', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger(WineVariety::PROJECT_ID);
            $table->string(WineVariety::TITLE);
            $table->string(WineVariety::CODE);

            $table->foreign(WineVariety::PROJECT_ID)->references('id')->on('projects');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('wine_varieties');
    }
}
