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
        Schema::create('emails', function (Blueprint $table) {
            $table->engine = "InnoDB";
            $table->id();
            $table->string('subject')->nullable();
            $table->text('body')->nullable();
            $table->text('to')->nullable();
            $table->text('cc')->nullable();
            $table->string('model')->nullable();
            $table->string('ids')->nullable();
            $table->string('view')->nullable();
            $table->foreignId('notifier_id')->nullable()->constrained('users')->cascadeOnUpdate()->nullOnDelete();
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
        Schema::disableForeignKeyConstraints();
            Schema::dropIfExists('emails');
        Schema::enableForeignKeyConstraints();
    }
};
