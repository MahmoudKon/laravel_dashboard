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
        Schema::create('products', function (Blueprint $table) {
            $table->engine = "InnoDB";
            $table->id();
             $table->string('title')->unique();
            $table->json('intro')->comment('translations');
            $table->text('description')->nullable();
            $table->string('video')->comment('video');
            $table->string('audio')->comment('audio');
            $table->string('file')->comment('file');
            $table->string('image')->comment('image');
            $table->boolean('active')->comment('0=unactive , 1=active')->default(1);
            $table->foreignId('user_id')->constrained('users')->cascadeOnUpdate()->cascadeOnDelete() ;
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
        Schema::dropIfExists('products');
    }
};
