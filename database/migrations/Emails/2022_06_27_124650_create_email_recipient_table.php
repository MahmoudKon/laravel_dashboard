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
        Schema::create('email_recipient', function (Blueprint $table) {
            $table->engine = "InnoDB";
            $table->foreignId('email_id')->constrained('emails')->cascadeOnUpdate()->cascadeOnDelete();
            $table->foreignId('recipient_id')->constrained('users')->cascadeOnUpdate()->cascadeOnDelete();
            $table->boolean('is_sender')->default(false)->comment('if true: then this id is the sender');
            $table->boolean('seen')->default(false);
            $table->timestamp('seen_time')->nullable();
            $table->primary(['email_id', 'recipient_id']);
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
            Schema::dropIfExists('email_recipient');
        Schema::enableForeignKeyConstraints();
    }
};
