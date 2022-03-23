<?php

use App\Models\Wine;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateWinesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('wines', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger(Wine::PROJECT_ID);
            $table->unsignedBigInteger(Wine::WINE_VARIETY_ID);
            $table->unsignedBigInteger(Wine::WINE_CLASSIFICATION_ID);
            $table->string(Wine::TITLE);
            $table->string(Wine::YEAR);
            $table->float(Wine::ALCOHOL)->nullable();
            $table->float(Wine::ACID)->nullable();
            $table->float(Wine::SUGAR)->nullable();
            $table->timestamps();

            $table->foreign(WINE::PROJECT_ID)->references('id')->on('projects');
            $table->foreign(WINE::WINE_VARIETY_ID)->references('id')->on('wine_varieties');
            $table->foreign(WINE::WINE_CLASSIFICATION_ID)->references('id')->on('wine_classifications');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('wines');
    }
}
