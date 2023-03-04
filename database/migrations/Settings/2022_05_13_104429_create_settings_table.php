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
        Schema::create('settings', function (Blueprint $table) {
            $table->engine = "InnoDB";
            $table->id();
            $table->string('key')->unique('key');
            $table->text('value');
            $table->foreignId('input_type_id')->nullable()->constrained('input_types')->cascadeOnUpdate()->nullOnDelete();
            $table->boolean('active')->default(true);
            $table->boolean('autoload')->default(false);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('settings');
    }
};
