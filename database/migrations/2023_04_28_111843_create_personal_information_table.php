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
        Schema::create('personal_information', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->references('id')->on('users')->onDelete('cascade');
            $table->string('gender')->default('Laki-laki');
            $table->string('birthday', 15)->change()->nullable();
            $table->string('phone_number', 17)->change()->nullable();
            $table->string('type_of_residence')->nullable(); //(apart, asrama)
            $table->string('province', 50)->nullable()->change();
            $table->string('city', 50)->nullable()->change();
            $table->string('district')->nullable();
            $table->text('address_tr')->nullable();
            $table->text('address_id')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('personal_information');
    }
};
