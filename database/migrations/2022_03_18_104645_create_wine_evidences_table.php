<?php

use App\Models\WineEvidence;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateWineEvidencesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('wine_evidences', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger(WineEvidence::PROJECT_ID);
            $table->string(WineEvidence::TITLE);
            $table->double(WineEvidence::VOLUME);
            $table->integer(WineEvidence::YEAR);
            $table->unsignedBigInteger(WineEvidence::WINE_CLASSIFICATION_ID)->nullable();
            $table->double(WineEvidence::ALCOHOL)->nullable();
            $table->double(WineEvidence::ACID)->nullable();
            $table->double(WineEvidence::SUGAR)->nullable();
            $table->string(WineEvidence::NOTE)->nullable();
            $table->timestamps();

            $table->foreign(WineEvidence::PROJECT_ID)->references('id')->on('projects');
            $table->foreign(WineEvidence::WINE_CLASSIFICATION_ID)->references('id')->on('wine_classifications');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('wine_evidences');
    }
}
