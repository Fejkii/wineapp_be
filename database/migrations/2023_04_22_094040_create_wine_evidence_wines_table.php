<?php

use App\Models\WineEvidenceWine;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('wine_evidence_wines', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger(WineEvidenceWine::WINE_EVIDENCE_ID);
            $table->unsignedBigInteger(WineEvidenceWine::WINE_ID);
            $table->timestamps();

            $table->foreign(WineEvidenceWine::WINE_EVIDENCE_ID)->references('id')->on('wine_evidences');
            $table->foreign(WineEvidenceWine::WINE_ID)->references('id')->on('wines');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('wine_evidence_wines');
    }
};
