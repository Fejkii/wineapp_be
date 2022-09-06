<?php

use App\Models\VineyardWine;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateVineyardWinesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('vineyard_wines', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger(VineyardWine::VINEYARD_ID);
            $table->unsignedBigInteger(VineyardWine::WINE_ID);
            $table->string(VineyardWine::TITLE);
            $table->integer(VineyardWine::QUANTITY);
            $table->string(VineyardWine::NOTE)->nullable();
            $table->timestamps();

            $table->foreign(VineyardWine::VINEYARD_ID)->references('id')->on('vineyards');
            $table->foreign(VineyardWine::WINE_ID)->references('id')->on('wines');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('vineyard_wines');
    }
}
