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
        Schema::create('menus', function (Blueprint $table) {
            $table->engine = "InnoDB";
            $table->id();
            $table->json('name');
            $table->string('route')->nullable();
            $table->string('icon')->nullable();
            $table->boolean('visible')->default(1);
            $table->string('color', 100)->default('#6B6F82');
            $table->foreignId('parent_id')->nullable()->constrained('menus')->cascadeOnUpdate()->nullOnDelete();
            $table->unsignedSmallInteger('order')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('menus');
    }
};
