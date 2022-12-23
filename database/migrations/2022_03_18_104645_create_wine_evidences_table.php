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
            $table->unsignedBigInteger(WineEvidence::WINE_ID);
            $table->unsignedBigInteger(WineEvidence::WINE_CLASSIFICATION_ID);
            $table->string(WineEvidence::TITLE);
            $table->float(WineEvidence::VOLUME);
            $table->integer(WineEvidence::YEAR);
            $table->float(WineEvidence::ALCOHOL)->nullable();
            $table->float(WineEvidence::ACID)->nullable();
            $table->float(WineEvidence::SUGAR)->nullable();
            $table->timestamps();

            $table->foreign(WineEvidence::PROJECT_ID)->references('id')->on('projects');
            $table->foreign(WineEvidence::WINE_ID)->references('id')->on('wines');
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
