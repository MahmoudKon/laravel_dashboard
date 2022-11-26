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
        Schema::create('announcements', function (Blueprint $table) {
            $table->engine = "InnoDB";
            $table->id();
            $table->foreignId('creator_id')->nullable()->constrained('users')->cascadeOnUpdate()->nullOnDelete();
            $table->string('title')->nullable();
            $table->text('desc')->nullable();
            $table->timestamp('start_date')->nullable();
            $table->timestamp('end_date')->nullable();
            $table->string('url')->nullable();
            $table->string('image')->nullable();
            $table->boolean('open_type')->default(true); // NEW_WINDOW,CURRENT_WINDOW
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
        Schema::dropIfExists('announcements');
    }
};
