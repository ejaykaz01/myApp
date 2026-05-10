<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('community_posts', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->text('content');
            $table->string('type')->default('update'); // update, alert, maintenance
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('community_posts');
    }
};