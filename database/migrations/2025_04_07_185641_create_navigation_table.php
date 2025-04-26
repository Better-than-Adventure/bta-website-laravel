<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('navigation', function (Blueprint $table) {
            $table->id();
            $table->string('label');
            $table->string('path')->nullable();
            $table->integer('sort_order')->default(0);
        });

        Schema::table('navigation', function (Blueprint $table) {
            $table->foreignId('parent_id')->nullable()->references('id')->on('navigation')->cascadeOnDelete();
        });
    }
};
