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
        Schema::table('conversations', function (Blueprint $table) {
            $table->foreignId('last_message_id')->nullable()->constrained('messages')->cascadeOnUpdate()->nullOnDelete();
        });

        if (! Schema::hasColumn('users', 'last_seen')) {
            Schema::table('users', function (Blueprint $table) {
                $table->timestamp('last_seen')->nullable();
            });
        }
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('conversations', function (Blueprint $table) {
            $table->dropConstrainedForeignId('last_message_id');
        });
    }
};
