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
        Schema::create('routes', function (Blueprint $table) {
            $table->engine = "InnoDB";
            $table->id();
            $table->text('controller');
            $table->string('func');
            $table->string('method');
            $table->text('middleware')->nullable();
            $table->string('namespace')->nullable();
            $table->string('uri');
            $table->string('route')->nullable();
            $table->string('prefix')->nullable();
            $table->string('where')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('routes');
    }
};
