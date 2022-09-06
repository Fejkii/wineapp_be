<?php

use App\Models\Vineyard;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateVineyardsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('vineyards', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger(Vineyard::PROJECT_ID);
            $table->string(Vineyard::TITLE);
            $table->timestamps();

            $table->foreign(Vineyard::PROJECT_ID)->references('id')->on('projects');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('vineyards');
    }
}
