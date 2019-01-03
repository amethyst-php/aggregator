<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\Schema;

class CreateAggregatorsTable extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
    {
        Schema::create(Config::get('amethyst.aggregator.data.aggregator.table'), function (Blueprint $table) {
            $table->increments('id');
            $table->string('source_type');
            $table->integer('source_id');
            $table->string('aggregate_type');
            $table->integer('aggregate_id');
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down()
    {
        Schema::dropIfExists(Config::get('amethyst.aggregator.data.aggregator.table'));
    }
}
