<?php

use App\Models\WineRecordType;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateWineRecordTypesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('wine_record_types', function (Blueprint $table) {
            $table->id();
            $table->string(WineRecordType::TITLE);
            $table->string(WineRecordType::COLOR)->nullable();
            $table->string(WineRecordType::NOTE)->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('wine_record_types');
    }
}
