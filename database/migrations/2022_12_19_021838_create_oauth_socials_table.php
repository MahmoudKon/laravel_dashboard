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
        Schema::create('oauth_socials', function (Blueprint $table) {
            $table->engine = "InnoDB";
            $table->id();
            $table->string('display_name')->unique();
            $table->string('name')->unique();
            $table->string('icon', 50)->nullable();
            $table->string('color', 20)->nullable();
            $table->boolean('active')->default(true);
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
        Schema::dropIfExists('oauth_socials');
    }
};
