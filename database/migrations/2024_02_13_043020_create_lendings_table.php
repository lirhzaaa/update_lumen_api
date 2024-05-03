<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('lendings', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('stuff_id');
            $table->dateTime('date_time');
            $table->string('name');
            $table->bigInteger('user_id');
            $table->text('notes');
            $table->integer('total_stuff');
            $table->timestamps();
            $table->softDeletes();
        });

        Schema::table('lendings', function (Blueprint $table) {
            // Add foreign key for user_id
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
            // Add foreign key for stuff_id
            $table->foreign('stuff_id')->references('id')->on('stuff')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('lendings', function (Blueprint $table) {
            $table->dropForeign(['user_id']);
            $table->dropForeign(['stuff_id']);
        });
        Schema::dropIfExists('lendings');
    }
};
