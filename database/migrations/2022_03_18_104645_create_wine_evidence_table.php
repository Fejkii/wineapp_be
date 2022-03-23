<?php

use App\Models\WineEvidence;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateWineEvidenceTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('wine_evidence', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger(WineEvidence::PROJECT_ID);
            $table->unsignedBigInteger(WineEvidence::WINE_ID);
            $table->string(WineEvidence::TITLE);
            $table->float(WineEvidence::VOLUME);
            $table->timestamps();

            $table->foreign(WineEvidence::PROJECT_ID)->references('id')->on('projects');
            $table->foreign(WineEvidence::WINE_ID)->references('id')->on('wines');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('wine_evidence');
    }
}
