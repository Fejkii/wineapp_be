<?php

use App\Models\WineRecord;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateWineRecordsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('wine_records', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger(WineRecord::WINE_EVIDENCE_ID);
            $table->unsignedBigInteger(WineRecord::WINE_RECORD_TYPE_ID);
            $table->string(WineRecord::TITLE);
            $table->timestamp(WineRecord::DATE);
            $table->string(WineRecord::NOTE)->nullable();
            $table->timestamps();

            $table->foreign(WineRecord::WINE_EVIDENCE_ID)->references('id')->on('wine_evidences');
            $table->foreign(WineRecord::WINE_RECORD_TYPE_ID)->references('id')->on('wine_record_types');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('wine_records');
    }
}
