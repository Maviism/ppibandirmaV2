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
        Schema::create('events', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->string('venue');
            $table->dateTime('datetime');
            $table->string('type')->default('Public');
            $table->text('description');
            $table->string('responsible_dept')->nullable();
            $table->integer('total_participants')->default(0)->nullable(); //generate when event created
            $table->string('image_url')->nullable();
            $table->string('gallery_url')->nullable();
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('events');
    }
};
