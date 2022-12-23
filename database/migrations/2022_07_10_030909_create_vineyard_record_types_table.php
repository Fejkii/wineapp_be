<?php

use App\Models\VineyardRecordType;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateVineyardRecordTypesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('vineyard_record_types', function (Blueprint $table) {
            $table->id();
            $table->string(VineyardRecordType::TITLE);
            $table->string(VineyardRecordType::COLOR)->nullable();
            $table->string(VineyardRecordType::NOTE)->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('vineyard_record_types');
    }
}
