<?php

use App\Models\VineyardRecord;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateVineyardRecordsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('vineyard_records', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger(VineyardRecord::VINEYARD_RECORD_TYPE_ID);
            $table->string(VineyardRecord::TITLE);
            $table->timestamp(VineyardRecord::DATE);
            $table->unsignedBigInteger(VineyardRecord::VINEYARD_ID)->nullable();
            $table->unsignedBigInteger(VineyardRecord::VINEYARD_WINE_ID)->nullable();
            $table->string(VineyardRecord::NOTE)->nullable();
            $table->timestamps();

            $table->foreign(VineyardRecord::VINEYARD_ID)->references('id')->on('vineyards');
            $table->foreign(VineyardRecord::VINEYARD_WINE_ID)->references('id')->on('vineyard_wines');
            $table->foreign(VineyardRecord::VINEYARD_RECORD_TYPE_ID)->references('id')->on('vineyard_record_types');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('vineyard_records');
    }
}
