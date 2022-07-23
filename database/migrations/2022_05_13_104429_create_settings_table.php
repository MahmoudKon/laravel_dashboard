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
            $table->foreignId('content_type_id')->nullable()->constrained('content_types')->cascadeOnUpdate()->nullOnDelete();
            $table->unsignedSmallInteger('system')->default(1)->comment('if the project have multi system and each system has settings, 1 is default');
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
