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
            $table->unsignedBigInteger(VineyardRecord::VINEYARD_ID);
            $table->string(VineyardRecord::TITLE);
            $table->timestamp(VineyardRecord::DATE);
            $table->string(VineyardRecord::NOTE)->nullable();
            $table->timestamps();

            $table->foreign(VineyardRecord::VINEYARD_ID)->references('id')->on('vineyards');
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
