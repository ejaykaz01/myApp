<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
{
    Schema::create('items', function (Blueprint $table) {
        $table->id();

        $table->string('title');
        $table->text('description')->nullable();

        $table->enum('type', ['lost', 'found']);

        $table->string('image')->nullable();

        $table->enum('status', ['pending', 'approved', 'claimed'])
              ->default('pending');

        $table->string('location')->nullable();
        $table->string('contact')->nullable();

        $table->unsignedBigInteger('user_id');

        $table->timestamps();

        // FK to Breeze users table
        $table->foreign('user_id')
              ->references('id')
              ->on('users')
              ->onDelete('cascade');

        // Indexes (for DataTables + search)
        $table->index('type');
        $table->index('status');
        $table->index('title');
    });
}

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('items');
    }
};
