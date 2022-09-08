<?php

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
        Schema::create('sessions', function (Blueprint $table) {
            $table->id();
            $table->integer('id_manager');
            $table->double('cash_total')->default(0);
            $table->double('card_total')->default(0);
            $table->timestamp('date_start')->default(DB::raw('CURRENT_TIMESTAMP'));
            $table->double('date_end')->default(DB::raw('NULL'));
            
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('sessions');
    }
};
