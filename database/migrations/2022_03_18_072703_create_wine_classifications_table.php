<?php

use App\Models\WineClassification;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateWineClassificationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('wine_classifications', function (Blueprint $table) {
            $table->id();
            $table->string(WineClassification::TITLE);
            $table->string(WineClassification::CODE);
            $table->string(WineClassification::PARAMS)->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('wine_classifications');
    }
}
